<?php

namespace App\Http\Controllers\SuperAdmin;
use DB;
use App;
use Session;
use App\Models\RoomTypes;
use App\Models\FloorType;
use App\Models\RoomTypesFloorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = RoomTypesFloorType::all();
        $rooms = DB::table('floor_type_room_types')
            ->join('room_types', 'floor_type_room_types.room_types_id', '=', 'room_types.id')
            ->join('floor_types', 'floor_type_room_types.floor_type_id', '=', 'floor_types.id')
            ->select('floor_type_room_types.*','room_types.name as room_type_name','floor_types.name as floor_type_name')
            ->orderBy('room_types.name')
            ->get();
        //
        // dd($rooms);
        return view('Super_Admin.roomType.index')->withRooms($rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floors = FloorType::pluck('name','id');
        return view('Super_Admin.roomType.add')->withFloors($floors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|string',
            'floor' => 'required',
            'stnd_frequency' => 'required|numeric',
            'stnd_sq_meter_area' => 'required|numeric',
        ]);

        $roomType = new RoomTypes;
        $roomType->name = $request->name;
        $roomType->save();

        $roomType->floorTypes()->attach($request->floor,[
            'standard_frequency' => $request->stnd_frequency,
            'standard_meter_sq_hours' => $request->stnd_sq_meter_area,
            'comments' => $request->comments,
        ]);

        if (App::getLocale() == "en") {
                      Session::flash('success','Room type created successfully');
                    }else {
                      Session::flash('success','Ruimte type succesvol toegevoegd');
                    }
        return redirect()->route('roomType.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomTypes  $roomTypes
     * @return \Illuminate\Http\Response
     */
    public function show(RoomTypes $roomTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomTypes  $roomTypes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomType = RoomTypesFloorType::where('id','=',$id)->first();
        $floors = FloorType::pluck('name','id');
        $roomName = RoomTypes::select('name')->where('id','=',$roomType->room_types_id)->first();
        return view('Super_Admin.roomType.edit')
                    ->withRoomType($roomType)
                    ->withRoomName($roomName)
                    ->withFloors($floors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomTypes  $roomTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roomTypesID)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'floor' => 'required',
            'stnd_frequency' => 'required|numeric',
            'stnd_sq_meter_area' => 'required|numeric',
        ]);

        // dd($roomTypesID);
        $roomTypesFloorType = RoomTypesFloorType::where('id','=',$roomTypesID)->first();
        $roomType = RoomTypes::find($roomTypesFloorType->room_types_id);

        $roomType->name = $request->name;
        $roomType->save();
        $roomType->floorTypes()->attach($request->floor,[
            'standard_frequency' => $request->stnd_frequency,
            'standard_meter_sq_hours' => $request->stnd_sq_meter_area,
            'comments' => $request->comments,
        ]);

        $roomTypesFloorType->delete(); // deleting old record for update purpose

        if (App::getLocale() == "en") {
                      Session::flash('success','Room type updated successfully');
                    }else {
                      Session::flash('success','Ruimte type succesvol bijgewerkt');
                    }
        return redirect()->route('roomType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomTypes  $roomTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($roomTypesID)
    {

    }

    public function deleteType($roomTypesID)
    {
        $roomTypesFloorType = RoomTypesFloorType::where('id','=',$roomTypesID)->first();
        $roomType = RoomTypes::find($roomTypesFloorType->room_types_id);

        $roomTypesFloorType->delete();
        $roomType->delete();
        if (App::getLocale() == "en") {
          Session::flash('success','Room type deleted successfully');
        }else {
          Session::flash('success','Ruimte type succesvol verwijderd');
        }
        return redirect()->route('roomType.index');
    }
}
