<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Element;
use DB;
use App;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['elements'] = Element::all();
      return view('Super_Admin.elements.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Super_Admin.elements.add');
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

      $element = new Element;
      $element->name = $request->name;
      $element->name_eng = $request->name_eng;
      $element->save();
      if (App::getLocale() == "en") {
            Session::flash('success','Element added successfully');
       }else {
         Session::flash('success','Element succesvol toegevoegd');
       }

      return redirect()->route('element.index');
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
    public function edit(Element $element)
    {
      return view('Super_Admin.elements.edit',compact('element'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Element $element)
    {
      $request->validate([
        'name' => 'required|max:255',
        'name_eng' => 'required|max:255'
        ]);

      $element->name = $request->name;
      $element->name_eng = $request->name_eng;
        // $element->hours = $request->hours;
        // $element->minutes = $request->minutes;
        $element->save();

      if (App::getLocale() == "en") {
            Session::flash('success','Element updated successfully');
       }else {
         Session::flash('success','Element succesvol bijgewerkt');
       }
      return redirect()->route('element.index');
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

    public function deleteRecord(Element $element)
    {
        $element->delete();

      if (App::getLocale() == "en") {
            Session::flash('success','Element deleted successfully');
       }else {
         Session::flash('success','Element succesvol verwijderd');
       }
      return redirect()->route('element.index');
    }
}
