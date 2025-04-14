<?php

namespace App\Http\Controllers\Common;

use DB;
use App;
use Auth;
use Session;
use Response;
use App\Models\Area;
use App\Models\Floor;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Comp_id  = Auth::user()->id;
      $areas    = Area::where('company_id','=',$Comp_id)->get();
      return view('Company_Admin.area.index')->withAreas($areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Company_Admin.area.add');
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
        'name' => 'required|max:255'
        ]);

      $Comp_id          = Auth::user()->id;
      $area             = new Area;
      $area->name       = $request->name;
      $area->company_id = $Comp_id;
      $area->save();

      if (App::getLocale() == "en") {
        Session::flash('success','Area added Successfuly');
      }else {
        Session::flash('success','Ruimte toegevoegd met succes');
      }
      return redirect()->route('area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
      return view('Company_Admin.area.edit')->withArea($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
      $request->validate([
        'name' => 'required|max:255',
        ]);

      $area->name       = $request->name;
      $area->save();

      if (App::getLocale() == "en") {
        Session::flash('success','Area updated Successfuly');
      }else {
        Session::flash('success','Ruimte succesvol bijgewerkt');
      }
      return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }

    public function deleteRecord(Area $area)
    {
      $area->delete();

      Session::flash('success','Area deleted Successfuly (Gebied verwijderd)');
      return redirect()->route('area.index');
    }

    public function getAreas($id)
    {//get Areas of specific Floors for this company
        $areas = Area::select('name','id')
                     ->where('floor_id','=',$id)
                     ->where('company_id','=',$Comp_id)
                     ->get();
        return Response::json($areas);
    }
}
