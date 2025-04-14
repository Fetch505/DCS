<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use Auth;
use Session;
use App\Models\MaterialCategory;
use App\Models\MaterialType;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $materialTypes = MaterialType::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.materialType.index', compact('materialTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = Auth::id();
        $materialCategories  = MaterialCategory::where('company_id', '=', $company_id)->select('name','id')->get();
        return view('Company_Admin.materialType.add', compact('materialCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
          'name' => 'required|string|max:255',
          'material_category_id' => 'required|exists:material_categories,id',
        ]);
        $data['company_id'] = Auth::id();

        MaterialType::create($data);

        Session::flash('success','Material Type added Successfuly');
        return redirect()->route('materialType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialType $materialType)
    {
        return view('Company_Admin.materialType.view', compact('materialType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialType $materialType)
    {
        $company_id = Auth::id();
        $materialCategories  = MaterialCategory::where('company_id', '=', $company_id)->pluck('name','id');
        return view('Company_Admin.materialType.edit', compact('materialType','materialCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialType $materialType)
    {
        // Validating the incoming request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'material_category_id' => 'required|exists:material_categories,id',
        ]);

        // Updating the material category
        $materialType->update($data);

        // Redirecting back with a success message
        return redirect()->route('materialType.index')->with('success', 'Material Type updated successfully');
    }

    public function getMaterialTypes($categoryId)
    {
        $materialTypes = MaterialType::where('material_category_id', $categoryId)->pluck('name', 'id');
        return response()->json($materialTypes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function deleteRecord(MaterialType $materialType)
    {
        // Deleting the material category
        $materialType->delete();

        // Redirecting back with a success message
        return redirect()->route('materialType.index')->with('success', 'Material type deleted successfully');
    }

}