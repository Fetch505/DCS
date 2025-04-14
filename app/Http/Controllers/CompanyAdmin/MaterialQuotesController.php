<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\quotesRequest;
use App\Mail\SendEmails;
use App\Jobs\SendQuotesEmail;
use App\Models\Project;
use App\Models\Material;
use App\Http\Resources\MaterialResource;
use App\Http\Controllers\Controller;

class MaterialQuotesController extends Controller
{
  // project material quotes starts from here
    public function quotesIndex(){
        return view('Company_Admin.quotes.index');
    }


    public function projectList(){
        $list = Project::select('name','id')->where('status','=',1)->get();

        return response()->json([
            'projectList' => $list,
            'status'      => 1,
        ],200);
    }

    public function quoteRequest($id){
        $project = Project::select('name','id')
                            ->where('id','=',$id)
                            ->first();
        return view('Company_Admin.quotes.requestForQuote')
                    ->withProject($project);
    }

    public function quoteList($id){
        $project_material = Project::find($id);
        $quotesList = DB::table('material_project')
                   ->join('materials','materials.id','=', 'material_project.material_id')
                   ->where('material_project.project_id','=',$id)
                   ->select('material_project.quantity as material_quantity','materials.name as material_name','materials.created_at as date')->get();

        return response()->json([
            'proj_materials' => $quotesList,
            'status'        => 1,
        ],200);
    }

    public function materialList(){
        $project_material = Material::select('name','id')->get();
        return response()->json([
            'proj_materials' => $project_material,
            'status'        => 1,
        ],200);
    }

    public function placeOrder(Request $request){
        $proj_id = $request->project_id;

        $project = Project::find($proj_id);
        $mail_list = [];

        foreach ($request->items as $key => $item) {
            $material_id = $item['material_id'];
            $quantity = $item['quantity'];
            $project->materials()->attach($material_id, ['quantity' => $quantity,
            'created_at' => Carbon::now(),
            ]);
            //get supplier email on the basis of material id
            //make array of email
            $material = Material::find($material_id);
            $mail_list[$key] = new MaterialResource($material);
            // $temp = $mail_list[$key];

            $mail_list[$key]->quantity = $quantity;
        }

        $from = Auth::user()->email;

        //send emails in que
        SendQuotesEmail::dispatch($mail_list,$from);

        return response()->json([
            'mailList' => $mail_list,
            'status'   => 1,
        ],200);
    }
    // project material quotes ends from here
}
