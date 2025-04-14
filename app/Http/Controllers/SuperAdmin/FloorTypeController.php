<?php

namespace App\Http\Controllers\SuperAdmin;
use App;
use Session;
use App\Models\FloorType;
use App\Models\Element;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FloorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('floor type');
        $floorTypes = FloorType::all();
        return view('Super_Admin.floorType.index')->withFloorTypes($floorTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $elements = Element::all();

        //dd($elements);
        return view('Super_Admin.floorType.add',['elements' => $elements]);
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
        'element' => 'required|max:255',
        ]);

      $type = new FloorType;
      $type->name = $request->name;
      $type->element_id = $request->element;
      $type->save();

      if (App::getLocale() == "en") {
              Session::flash('success','Floor type added successfully');
            }else {
              Session::flash('success','Vloer type succesvol toegevoegd');
            }
      return redirect()->route('floorType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FloorType  $floorType
     * @return \Illuminate\Http\Response
     */
    public function show(FloorType $floorType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FloorType  $floorType
     * @return \Illuminate\Http\Response
     */
    public function edit(FloorType $floorType)
    {
        //dd($floorType);
        $elements = Element::all();
        //return view('Super_Admin.floorType.edit')
        //                ->withFloorType($floorType);

        return view('Super_Admin.floorType.edit', compact('floorType', 'elements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FloorType  $floorType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FloorType $floorType)
    {
      $request->validate([
        'name' => 'required|max:255',
        'element_id' => 'required|max:255',
      ]);

      $floorType->name = $request->name;
      $floorType->element_id = $request->element_id;
      $floorType->save();

      if (App::getLocale() == "en") {
              Session::flash('success','Floor type updated successfully');
            }else {
              Session::flash('success','Vloer type succesvol bijgewerkt');
            }
      return redirect()->route('floorType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FloorType  $floorType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FloorType $floorType)
    {
        //
    }

    public function deleteFloorType(FloorType $floorType)
    {
      $floorType->delete();

      if (App::getLocale() == "en") {
              Session::flash('success','Floor type deleted successfully');
            }else {
              Session::flash('success','Vloer type succesvol verwijderd');
            }
      return redirect()->route('floorType.index');
    }
}
