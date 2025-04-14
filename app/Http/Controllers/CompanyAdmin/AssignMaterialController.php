<?php

namespace App\Http\Controllers\CompanyAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialType;
use App\Models\Project;
use App\Models\User;
use App\Models\MaterialProjectTransaction;
use Auth;
use Illuminate\Support\Facades\Validator;

class AssignMaterialController extends Controller
{
    public function assignMaterials(Request $request)
    {
        $projectId = $request->input('projectId');
        $company_id = Auth::id();
        $project = Project::where('projects.id','=',$projectId)->first();
        $materialCategories  = MaterialCategory::where('company_id', '=', $company_id)->select('name','id')->get();
        $materialTypes  = MaterialType::where('company_id', '=', $company_id)->select('name','id')->get();
        $materials = Material::where('company_id', '=', $company_id)->get();

        foreach ($materials as $material) {
            $materialProject = $material->projects()->wherePivot('project_id', $projectId)->first();
            $material->consumption_per_day = $materialProject ? $materialProject->pivot->consumption_per_day : 0;
            $material->consumable = $material->materialType->materialCategory->consumable;
        }

        return view('Company_Admin.assign_material.index', compact('project','materialCategories','materialTypes','materials'));
    }
    

    public function getTypes(Request $request)
    {
        $projectId = $request->input('projectId');
        $categoryId = $request->input('categoryId');
        $materialTypes = MaterialType::where('material_category_id', $categoryId)->get();
        $materials = [];

        foreach ($materialTypes as $materialType) {
            foreach ($materialType->materials as $material) {
                $project = $material->projects->firstWhere('id', $projectId);
                $material->consumption_per_day = $project ? $project->pivot->consumption_per_day : 0;
                $material->consumable = $material->materialType->materialCategory->consumable;
                $materials[] = $material;
            }
        }

        return response()->json([
            'materials' => $materials,
            'materialTypes' => $materialTypes
        ]);
    }

    public function getMaterials(Request $request)
    {
        $projectId = $request->input('projectId');
        $typeId = $request->input('typeId');
        $materials = Material::where('material_type_id', $typeId)->get();
        $materialCategoryID = MaterialType::where('id', $typeId)->value('material_category_id');

        foreach ($materials as $material) {
            $materialProject = $material->projects()->wherePivot('project_id', $projectId)->first();
            $material->consumption_per_day = $materialProject ? $materialProject->pivot->consumption_per_day : 0;
            $material->consumable = $material->materialType->materialCategory->consumable;
        }

        return response()->json([
            'materials' => $materials,
            'material_category_id' => $materialCategoryID
        ]);
    }


    public function storeMaterials(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        // Validate request data
        $validator = Validator::make($request->all(), [
            'paymentProof' => 'nullable|file',
            'materials' => 'required|string',
            'materials.*.id' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|integer|min:0',
            'materials.*.consumption' => 'required|integer|min:0',
            'totalQuantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Handle file upload
        $filePath = '';
        if ($request->hasFile('paymentProof')) {
            $paymentProof = $request->file('paymentProof');
            $fileName = 'paymentProof-' . time() . '.' . $paymentProof->getClientOriginalExtension();
            $filePath = $paymentProof->move(public_path('paymentProof'), $fileName);

            if (!$filePath) {
                return response()->json(['error' => 'Failed to save paymentProof file.'], 422);
            }
            $filePath = asset('paymentProof/' . $fileName);
        }

        // Process quantities data
        $materials = json_decode($request->input('materials'), true);

        foreach ($materials as $material) {
            $materialId = $material['id'];
            $quantity = $material['quantity'];
            $consumption = $material['consumption'];

            $material = Material::findOrFail($materialId);

            // Check if the material is already assigned to the project
            if ($project->materials->contains($materialId)) {
                $existingQuantity = $project->materials()->where('material_id', $materialId)->first()->pivot->quantity;
                $newQuantity = $existingQuantity + $quantity;
                $project->materials()->updateExistingPivot($materialId, [
                    'quantity' => $newQuantity,
                    'consumption_per_day' => $consumption
                ]);
            } else {
                // If not assigned, attach the material to the project with the given quantity
                $project->materials()->attach($materialId, [
                    'quantity' => $quantity,
                    'consumption_per_day' => $consumption
                ]);
            }

            // Update the available quantity in the materials table
            $material->decrement('quantity', $quantity);
        }      
        
        // Store data in material_transactions table
        MaterialProjectTransaction::create([
            'project_id' => $projectId,
            'payment_proof' => $filePath,
            'total_quantity' => $request->input('totalQuantity'),
        ]);

        return response()->json(['redirectUrl' => route('project.show', $projectId)],200);
    }

    public function materialTransactions(Request $request)
    {
        $projectId = $request->input('projectId');
        $project = Project::where('projects.id','=',$projectId)->first();
        $materialTransactions  = MaterialProjectTransaction::where('project_id', '=', $projectId)->orderBy('created_at', 'desc')->get();

        return view('Company_Admin.assign_material.transaction', compact('project', 'materialTransactions'));
    }

    public function assignedUsers(Request $request)
    {
        $projectId = $request->input('projectId');
        $materialId = $request->input('materialId');
        $project = Project::findOrFail($projectId);
        $material = Material::findOrFail($materialId);
        $material->usage = $material->materialType->materialCategory->has_usage_limit;
        $availableQuantity = $project->materials()->where('material_id', $materialId)->first()->pivot->quantity;

        $user_ids   = [];
        foreach ($project->jobs as $key=>$job) {
            foreach ($job->days as $key=>$day) {
                if($day->status == 1){
                    $user_ids[] = $day->user->id;
                }
            }
        }
        $user_ids = array_unique($user_ids);
        $users = User::whereIn('id', $user_ids)->select('name','id')->get(); // Or you can fetch specific users based on your criteria

        foreach ($users as $user) {
            $quantity = (int) $material->assignedUsers()
                    ->wherePivot('project_id', $projectId)
                    ->wherePivot('user_id', $user->id)
                    ->sum('quantity');
    
            $user->assignedQuantity = $quantity;
        }

        return view('Company_Admin.assign_material.assign_users', compact('project', 'material', 'users', 'availableQuantity'));
    }

    public function userAssignments(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'project_id'        => 'required|exists:projects,id',
            'material_id'       => 'required|exists:materials,id',
            'users'             => 'required|array',
            'users.*.id'        => 'exists:users,id',
            'users.*.quantity'  => 'required|integer|min:1',
            'usage_limit'       => 'required|integer|min:0',
            'totalQuantity'       => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $project_id = $request->input('project_id');
        $material_id = $request->input('material_id');
        $user_assignments   = $request->input('users');
        $usage_limit = $request->input('usage_limit');
        $totalQuantity = $request->input('totalQuantity');

        $project = Project::findOrFail($project_id);
        $material = Material::findOrFail($material_id);

        foreach ($user_assignments as $user_assignment) {
            $user_id = $user_assignment['id'];
            $quantity = $user_assignment['quantity'];
    
            // Attach user to the material using assignedUsers relationship
            $material->assignedUsers()->attach($user_id, [
                'project_id' => $project_id,
                'usage_limit' => $usage_limit,
                'quantity' => $quantity,
            ]);
        }
        $quantity = $project->materials()->where('material_id', $material_id)->first()->pivot->quantity;
        $new_quantity = $quantity - $totalQuantity;
        $project->materials()->updateExistingPivot($material_id, ['quantity' => $new_quantity]);

        return response()->json(['redirectUrl' => route('project.show', $project_id)],200);
    }

}
