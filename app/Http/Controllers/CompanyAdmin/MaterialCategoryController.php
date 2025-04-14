<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use Auth;
use Session;
use App\Models\MaterialCategory;
use App\Models\MaterialType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MaterialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $materialCategories = MaterialCategory::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.materialCategory.index', compact('materialCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.materialCategory.add');
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
          'consumable' => 'sometimes|boolean',
          'has_usage_limit' => 'sometimes|boolean',
        ]);
        $data['company_id'] = Auth::id();


        MaterialCategory::create($data);
        return redirect()->route('materialCategory.index')->with('success', 'Material category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialCategory $materialCategory)
    {
        return view('Company_Admin.materialCategory.view', compact('materialCategory'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialCategory $materialCategory)
    {
        return view('Company_Admin.materialCategory.edit', compact('materialCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialCategory $materialCategory)
    {
        // Validating the incoming request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            // 'consumable' => 'sometimes|boolean',
            // 'has_usage_limit' => 'sometimes|boolean',
        ]);

        // Updating the material category
        $materialCategory->update($data);

        // Redirecting back with a success message
        return redirect()->route('materialCategory.index')->with('success', 'Material category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function deleteRecord(MaterialCategory $materialCategory)
    {
        // Deleting the material category
        $materialCategory->delete();

        // Redirecting back with a success message
        return redirect()->route('materialCategory.index')->with('success', 'Material category deleted successfully');
    }

}