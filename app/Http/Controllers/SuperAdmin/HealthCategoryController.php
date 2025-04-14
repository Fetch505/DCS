<?php

namespace App\Http\Controllers\SuperAdmin;
use URL;
use DB;
use PDF;
use App;
use Hash;
use Auth;
use Lang;
use Session;
use Carbon\Carbon;
use App\Models\HealthCategory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HealthCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category = HealthCategory::all();
      return view('Super_Admin.healths_category.index')->withCategory($category);
    }

    public function create()
    {
        return view('Super_Admin.healths_category.add');
    }

    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required|max:255',
      ]);

        $category = new HealthCategory;
        $category->name = $request->name;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        if (App::getLocale() == "en") {
          Session::flash('success','Category added successfully');
        }else {
          Session::flash('success','Category succesvol toegevoegd');
        }

      return redirect()->route('healthCategory.index');

    }

    public function edit(HealthCategory $healthCategory)
    {
      return view('Super_Admin.healths_category.edit', [
        'category' => $healthCategory,
        'exception' => false,
      ]);
    }

    public function update(Request $request, HealthCategory $healthCategory)
    {
      $request->validate([
        'name' => 'required|max:255',
      ]);
      
      $category                 = HealthCategory::where('id','=',$healthCategory->id)->first();
      $category->name           = $request->name;
      $category->updated_at     = carbon::now();
      $category->save();

      if (App::getLocale() == "en") {
        Session::flash('success','Category updated successfully');
      }else {
        Session::flash('success','Category succesvol updated');
      }

      return view('Super_Admin.healths_category.edit', [
        'category' => $category,
        'exception' => false,
      ]);
      
    }

}