<?php

namespace App\Http\Controllers\CompanyAdmin;

use App;
use Auth;
use Session;
use App\Models\Floor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floors = Floor::where('company_id', '=', Auth::id())->get();
        return view('Company_Admin.floor.index')->withFloors($floors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.floor.add');
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
        'name' => 'required|max:255',
        ]);

      $floor = new Floor;
      $floor->name = $request->name;
      $floor->company_id = Auth::id();
      $floor->save();


      if (App::getLocale() == "en") {
           Session::flash('success','Floor added successfully');
         }else {
           Session::flash('success','Vloer succesvol toegevoegd');
         }
      return redirect()->route('floor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
      return view('Company_Admin.floor.edit')->withFloor($floor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {
        $request->validate([
          'name' => 'required|max:255',
        ]);

        $floor->name = $request->name;
        $floor->save();

        if (App::getLocale() == "en") {
             Session::flash('success','Floor updated successfully');
           }else {
             Session::flash('success','Vloer succesvol bijgewerkt');
           }
        return redirect()->route('floor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        //
    }

    public function deleteRecord(Floor $floor)
    {
      $floor->delete();

      if (App::getLocale() == "en") {
           Session::flash('success','Floor deleted successfully');
         }else {
           Session::flash('success','Vloer succesvol verwijderdt');
         }
      return redirect()->route('floor.index');
    }
}
