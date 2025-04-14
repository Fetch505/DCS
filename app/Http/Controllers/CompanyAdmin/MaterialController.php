<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use Auth;
use Session;
use App\Models\Material;
use App\Models\MaterialOrder;
use App\Models\MaterialOrderDetail;
use App\Models\MaterialCategory;
use App\Models\MaterialType;
use App\Models\Supplier;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Mail\SupplierNotification;
use Illuminate\Support\Facades\Mail;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $materials = Material::with('materialType.materialCategory')
                  ->where('company_id', '=', $company_id)->get();
      return view('Company_Admin.material.index')->withMaterials($materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $company_id = Auth::id();
      $suppliers = Supplier::where('company_id', '=', $company_id)->select('name','id')->get();
      $categories  = MaterialCategory::where('company_id', '=', $company_id)->select('name','id')->get();
      return view('Company_Admin.material.add',compact('suppliers','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|string|max:255',
          'price' => 'required|integer',
          'quantity' => 'required|integer|min:0',
          'material_type' => 'required',
          'suppliers' => 'required',
        ]);

        $company_id = Auth::id();
        $material = new Material;
        $material->name = $request->name;
        $material->price = $request->price;
        $material->quantity = $request->quantity;
        $material->company_id = $company_id;
        $material->material_type_id = $request->material_type;
        $material->save();

        foreach ($request->suppliers as $key => $supplier) {
          $material->suppliers()->attach($supplier);
        }

        Session::flash('success','Material added Successfuly');
        return redirect()->route('material.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $material = $material->load('materialType.materialCategory');
        return view('Company_Admin.material.view')->withMaterial($material);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        $company_id = Auth::id();
        $suppliers = Supplier::where('company_id', '=', $company_id)->pluck('name','id');
        $categories  = MaterialCategory::where('company_id', '=', $company_id)->select('name','id')->get();
        $types   = MaterialType::where('material_category_id', '=', $material->materialType->materialCategory->id)->select('name','id')->get();
        return view('Company_Admin.material.edit',compact('suppliers','material','categories','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
          'name' => 'required|max:255',
          'price' => 'required|max:255',
          'quantity' => 'required|integer|min:0',
          'limit' => 'required|integer|min:0',
          'material_type' => 'required',
          'suppliers' => 'required',
          ]);

        $material->name = $request->name;
        $material->price = $request->price;
        $material->quantity = $request->quantity;
        $material->limit = $request->limit;
        $material->material_type_id = $request->material_type;
        $material->save();

        $material->suppliers()->detach();

        foreach ($request->suppliers as $key => $supplier) {
          $material->suppliers()->attach($supplier);
        }

        Session::flash('success','Material info updated Successfuly');
        return redirect()->route('material.index');
    }

    public function order()
    {
      $company_id = Auth::id();
      $projects = Project::where('company_id', '=', $company_id)->get();
      $categories  = MaterialCategory::with('materialTypes.materials.suppliers')->where('company_id', '=', $company_id)->select('name','id')->get();
      // dd($projects);
      return view('Company_Admin.material.order', compact('projects','categories'));
    }

    public function orderMaterials(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'materials'                   => 'required|array',
            'materials.*.name'            => 'required|string',
            'materials.*.quantity'        => 'required|integer|min:1',
            'materials.*.supplier.id'     => 'required|integer',
            'materials.*.supplier.name'   => 'required|string',
            'materials.*.supplier.email'  => 'required|email',
            'totalQuantity'               => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
          $materials = $request->input('materials');
          $totalQuantity = $request->input('totalQuantity');
          $suppliersData = [];

          $order = MaterialOrder::create([
              'company_id' => Auth::id(),
              'quantity' => $totalQuantity
          ]);
      
          foreach ($materials as $material) {
            $supplierEmail = $material['supplier']['email'];

            if (!isset($suppliersData[$supplierEmail])) {
              $suppliersData[$supplierEmail] = [
                'name' => $material['supplier']['name'],
                'materials' => []
              ];
            }

            $project = $material['project'] ?? [
              'id' => Auth::id(),
              'name' => Auth::user()->name,
              'address' => Auth::user()->address
            ];

            $suppliersData[$supplierEmail]['materials'][] =[
              'name' => $material['name'],
              'quantity' => $material['quantity'],
              'location' => $project['name'],
            ];

            MaterialOrderDetail::create([
              'order_id' => $order->id,
              'material_id' => $material['id'],
              'quantity' => $material['quantity'],
              'project' => $project['name'],
              'supplier_id' => $material['supplier']['id'],
            ]);
          }

          foreach ($suppliersData as $supplierEmail => $supplierData) {
              Mail::to($supplierEmail)
                  ->send(new SupplierNotification($supplierData['materials'], $supplierData['name']));
          }
          return response()->json(['redirectUrl' => route('showMaterialOrders')],200);
        } 
        catch (\Exception $e) {
          return response()->json(['error' => 'Error ordering materials: ' . $e->getMessage()], 500);
        }  
    }

    public function showMaterialOrders()
    {
      $company_id = Auth::id();
      $orders = MaterialOrder::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.material.showOrders', compact('orders'));
    }

    public function MaterialOrderDetails($orderId)
    {
        $order = MaterialOrder::findOrFail($orderId);
        return view('Company_Admin.material.orderDetails', compact('order'));
    }

}
