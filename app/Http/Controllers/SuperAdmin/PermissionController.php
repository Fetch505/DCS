<?php

namespace App\Http\Controllers\SuperAdmin;
use App;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('Super_Admin.permissions.index')->withPermissions($permissions);
    }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('Super_Admin.permissions.add');
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
          $permission = new Permission;
          $permission->name = $request->name;
          $permission->slug = Str::slug($permission->name) . '-' . time();
          $permission->save();
          if (App::getLocale() == "en") {
                        Session::flash('success','Permission created successfully');
                      }else {
                        Session::flash('success','Machtigingen succesvol aangemaakt');
                      }
          return redirect()->route('sup_admin.permissionsIndex');
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
         public function edit(Permission $permission)
         {
           return view('Super_Admin.permissions.edit')->withPermission($permission);
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
           $permission = Permission::findOrFail($id);
           $permission->name = $request->name;
           $permission->save();
           if (App::getLocale() == "en") {
                      Session::flash('success','Permission updated successfully');
                    }else {
                      Session::flash('success','Machtigingen succesvol bijgewerkt');
                    }
           return redirect()->route('sup_admin.permissionsIndex');
         }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
         public function destroy(Permission $permission)
         {
           $permission->delete();
           if (App::getLocale() == "en") {
                      Session::flash('success','Permission deleted successfully');
                    }else {
                      Session::flash('success','Machtigingen succesvol verwijderd');
                    }
           return redirect()->route('sup_admin.permissionsIndex');
         }
}
