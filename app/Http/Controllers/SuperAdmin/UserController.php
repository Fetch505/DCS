<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\WorkerType;
use App\Models\Permission;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Session;
use Hash;
use App;
use DB;

use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('worker_type_id','!=',0)
                     ->where('status','=',1)
                     ->get();
        // dd($users);
        return view('Super_Admin.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::all();
      $types = WorkerType::pluck('name');
        return view('Super_Admin.users.add')->withPermissions($permissions)->withTypes($types);
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
          'email' => 'required|email|unique:users,email',
          'password' => 'required|max:255',
          'phone' => 'required|regex:/^(\+31)[0-9]{11}$/',
          'address' => 'required|max:255',
          'city' => 'required|max:255',
          'country' => 'required|max:255',
          'worker_type' => 'required|max:255',
          ],[
             'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxxxx).'
          ]);

        $role_id = Role::where('name','=','user')->pluck('id')->first();
        $user = new User;
        $user->role_id = $role_id;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->slug = Str::slug($request->name) . '-' . time();
        $user->phone = $request->phone;
        $user->company_id = 0;
        $user->worker_type_id = (int)$request->worker_type;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->country = $request->country;
        $user->fax = $request->fax;
        $user->notes = null;
        $user->email_verified_at = null;
        $user->created_at = carbon::now();
        $user->updated_at = carbon::now();
        $user->save();

        $permissions =Permission::all();
        foreach ($permissions as $key => $permission) {
          $val = "Permission".$permission->id;
          if($request->$val){
            $user->permissions()->attach((int)$request->$val);
          }
        }
        Session::flash('success','New user created successfuly (Nieuwe gebruiker succesvol aangemaakt)');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Super_Admin.users.view')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = WorkerType::pluck('name','id');
        $user = User::where('id','=',$id)->first();
        //getting all assigned permissions to this user
        $assigned_perm = $user->permissions;
        $data =array();

        foreach ($assigned_perm as $key => $value)
        {
          $data[$key] = $value->id;
        }

        $status = array();
        $permissions = Permission::all();

        foreach ($permissions as $key => $permission)
        {
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

        return view('Super_Admin.users.edit')->withUser($user)->withTypes($types)->withStatus($status);
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
        'email' => "required|email|unique:users,email,$id",
        'phone' => 'required|regex:/^(\+31)[0-9]{9}$/',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
        'country' => 'required|max:255',
        'worker_type_id' => 'required',
        ],[
            'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxx).'
        ]);

      $user = User::findOrFail($id);

     DB::table('users')
           ->where('id', $id)
           ->update([
             'name' => $request->name,
             'email' => $request->email,
             'worker_type_id' => (int)$request->worker_type_id,
             'phone' => $request->phone,
             'address' => $request->address,
             'city' => $request->city,
             'zipcode' => $request->zipcode,
             'country' => $request->country,
             'fax' => $request->fax,
           ]);

      DB::table('users_permissions')->where('user_id','=',$user->id)->delete();

      $permissions =Permission::all();
      foreach ($permissions as $key => $permission) {
        $val = "Permission".$permission->id;
        if($request->$val){
          $user->permissions()->attach((int)$request->$val);
        }
      }
      Session::flash('success','User details updated successfuly (Gebruikers gegevens succesvol bijgewerkt)');
      return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->permissions()->detach();
      $user->delete();
      Session::flash('success','User status updated successfuly (Gebruikers status succesvol bijgewerkt)');
      return redirect()->route('users.index');
    }

    public function statusChange(User $user)
    {
      DB::table('users')
            ->where('id', $user->id)
            ->update([
              'status' => ! $user->status
            ]);
      Session::flash('success','User status updated successfuly (Gebruikers status succesvol bijgewerkt)');
      return redirect()->route('users.index');
    }

    //////////all users
    public function allUsers()
    {
      $users = User::all();
      // dd($users);
      return view('Super_Admin.users.allUsers')->withUsers($users);
    }


    public function viewAllUser(User $user)
    {
      return view('Super_Admin.users.viewAllUsers')->withUser($user);
    }
}
