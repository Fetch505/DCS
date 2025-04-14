<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use App;
use Hash;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id = Auth::user()->id;
        // $user = User::find($id);
        // $company_id = $user->company_id;
        $company_id = Auth::id();
        $types = WorkerType::where('company_id', '=', $company_id)->get();
        return view('Company_Admin.staffType.index')->withTypes($types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.staffType.add');
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

        $company_id = Auth::id();
        $newWorker = new WorkerType;
        $newWorker->name = $request->name;
        $newWorker->company_id = $company_id;
        $newWorker->save();

        if (App::getLocale() == "en") {
              Session::flash('success','New worker type is created successfully');
            }else {
              Session::flash('success','Nieuw personeel soorten is gemaakt');
            }
        return redirect()->route('staffType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $type = WorkerType::findOrFail($id);
      return view('Company_Admin.staffType.edit')->with([
          'type' => $type
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required|max:255',
        ]);

        $worker = WorkerType::findOrFail($id);
        $worker->name = $request->name;
        $worker->save();

        if (App::getLocale() == "en") {
              Session::flash('success','Staff type details updated successfully');
            }else {
              Session::flash('success','Personeel soorten gegevens bijgewerkt');
            }
        return redirect()->route('staffType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteRecord($id)
    {
        $worker = WorkerType::findOrFail($id);
        $worker->delete();

        if (App::getLocale() == "en") {
          Session::flash('success','Staff type deleted successfully');
        }else {
          Session::flash('success','Personeel soorten succesvol verwijderd');
        }
        return redirect()->route('staffType.index');
    }
}
