<?php

namespace App\Http\Controllers\SuperAdmin;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class SuperAdminController extends Controller
{
  /**
   * Create a new controller instance.
  *
  * @return void
  */
 public function __construct()
 {
     $this->middleware('auth');
 }

 /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(){
    return view('Super_Admin.dashboard');
  }

  public function adminProfile()
  {
    return view('Super_Admin.profile');
  }

  public function adminDetail()
  {
    $id = Auth::user()->id;
    $admin_data = User::find($id);

    return response()->json([
      'admin_data' => $admin_data,
    ],200);
  }

  public function adminUpdateDetail(Request $request)
  {
    $id = Auth::user()->id;
    $admin = User::find($id);
    $admin->email = $request->email;
    $admin->password = Hash::make($request->password);
    $admin->last_update_by = $id;
    $admin->save();

    return response()->json([
      'status' => true,
    ],200);
  }

  public function permissionManage()
  {
    return view('Super_Admin.permissions.index');
  }

  public function paymentManage()
  {
    return view('Super_Admin.payments.index');
  }

  public function rolesManage()
  {
    return view('Super_Admin.roles.index');
  }
}
