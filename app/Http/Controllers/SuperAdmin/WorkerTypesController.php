<?php

namespace App\Http\Controllers\SuperAdmin;
use App;
use Session;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerTypesController extends Controller
{

    public function index()
    {
        $workers = WorkerType::all();
        return view('Super_Admin.workerTypes.index')->with([
            'workers' => $workers
        ]);
    }


    public function create()
    {
        return view('Super_Admin.workerTypes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:255',
          ]);

          $newWorker = new WorkerType;
          $newWorker->name = $request->name;
          $newWorker->save();

          if (App::getLocale() == "en") {
            Session::flash('success','New worker type is created successfully');
          }else {
            Session::flash('success','Nieuw werkers type is gemaakt');
          }
          return redirect()->route('workerTypes.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $worker = WorkerType::findOrFail($id);
        return view('Super_Admin.workerTypes.edit')->with([
            'worker' => $worker
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
          'name' => 'required|max:255',
          ]);

          $worker = WorkerType::findOrFail($id);
          $worker->name = $request->name;
          $worker->save();

          if (App::getLocale() == "en") {
            Session::flash('success','Worker type details updated successfully');
          }else {
            Session::flash('success','Werknemer type details bijgewerkt');
          }
          return redirect()->route('workerTypes.index');
    }


    public function destroy($id)
    {
        //
    }


    public function deleteThisRecord($id)
    {
        $worker = WorkerType::findOrFail($id);
        $worker->delete();

        if (App::getLocale() == "en") {
          Session::flash('success','Worker type deleted successfully');
        }else {
          Session::flash('success','Werker type succesvol verwijderd');
        }
        return redirect()->route('workerTypes.index');
    }
}
