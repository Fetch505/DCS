<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;
use DB;
use App;
use Session;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::all();
      return view('Super_Admin.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::all();
      return view('Super_Admin.roles.add')->withPermissions($permissions);
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
      $request->validate([
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        ]);
      $role = new Role;
      $role->name = $request->name;
      $role->description = $request->description;
      $role->slug = Str::slug($role->name) . '-' . time();
      $role->save();

      $key = 0;
      $val = "Permission".$key;
      while ($request->$val) {
         $role->permissions()->attach((int)$request->$val);
         $key = $key + 1;
         $val = "Permission".$key;
       }
       if (App::getLocale() == "en") {
                  Session::flash('success','Role created successfully');
                }else {
                  Session::flash('success','Rol succesvol aangemaakt');
                }
      return redirect()->route('sup_admin.rolesIndex');
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
    public function edit(Role $role)
    {
        $assigned_perm = $role->permissions;
        $data =array();
        // dd($assigned);
        foreach ($assigned_perm as $key => $value) {
          $data[$key] = $value->id;
        }
        // $my_per = array_values($my_per);
        $status = array();
        $permissions = Permission::all();
        foreach ($permissions as $key => $permission) {
          if(in_array($permission->id, $data))
          {
            $status[$key]['name'] = $permission->name;
            $status[$key]['id'] = $permission->id;
            $status[$key]['before'] = true;
            $status[$key]['edit'] = false;
          }//already checked

          else
          {
            $status[$key]['name'] = $permission->name;
            $status[$key]['id'] = $permission->id;
            $status[$key]['before'] = false;
            $status[$key]['edit'] = false;
          }
        }
        // dd($status);
         //dd(in_array($permissions[0]->name, $my_per));
        return view('Super_Admin.roles.edit')->withRole($role)->withPermissions($permissions)->withStatus($status);
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
        'description' => 'required|max:255',
        ]);
      $role = Role::findOrFail($id);
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();

      DB::table('roles_permissions')->where('role_id','=',$role->id)->delete();

      $all_permissions = Permission::all();
      $name = "Permission";
      foreach ($all_permissions as $key => $value) {
        $index = $name.$key;

        if(isset($request->$index)){
          $role->permissions()->attach((int)$request->$index);
        }
      }
      if (App::getLocale() == "en") {
                 Session::flash('success','Role updated successfully');
               }else {
                 Session::flash('success','Rol succesvol bijgewerkt');
               }
      return redirect()->route('sup_admin.rolesIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        if (App::getLocale() == "en") {
                   Session::flash('success','Role deleted successfully');
                 }else {
                   Session::flash('success','Rol succesvol verwijderd');
                 }
        return redirect()->route('sup_admin.rolesIndex');
    }
}
