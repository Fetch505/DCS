<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\Element;
use Auth;
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
        $company_id = auth()->id();

        $data = array();
        $data['elements'] = Element::where('company_id', $company_id)->get();

      //  dd($data['elements']);
      return view('Company_Admin.elements.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Company_Admin.elements.add');
    }
    public function allelements()
    {
      $elements = Element::withTrashed()->get();
      return response()->json($elements);
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

        //dd($request->name);

      // $existingElement = Element::where(function($query) use ($request) {
      // $query->where('name', $request->name);
      // })->first();



      // if (!is_null($existingElement)) {
      //     // Element already exists, so don't save it again
      //     if (App::getLocale() == "en") {
      //        Session::flash('error', 'Element already exists');
      //     } else {
      //         Session::flash('error', 'Element bestaat al');
      //     }

      //     return redirect()->back();


      //     //return redirect()->route('element.index');
      // }

      $company_id = Auth::id();
      $element = new Element;
      $element->name = $request->name;
      //$element->name_eng = $request->name_eng;
      $element->company_id = $company_id;
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
      return view('Company_Admin.elements.edit',compact('element'));
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
        //'name_eng' => 'required|max:255'
        ]);

      $element->name = $request->name;
      //$element->name_eng = $request->name_eng;
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
