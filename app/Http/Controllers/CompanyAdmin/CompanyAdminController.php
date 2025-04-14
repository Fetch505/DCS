<?php

namespace App\Http\Controllers\CompanyAdmin;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAdminController extends Controller
{
  public function index(){
    return redirect()->route('home');
  }

  public function companyProfile()
  {
    return view('Company_Admin.profile');
  }

  public function companyDetail()
  {
    $id = Auth::user()->id;
    $user = User::find($id);
    $com_id = Auth::id();
    $company = Company::find($com_id);

    return response()->json([
      'company_data' => $user,
      'company' => $company,
      // 'company' => $company->name,
    ],200);
  }

  public function companyUpdateDetail(Request $request)
  {
    $id = Auth::user()->id;
    $comapany = User::find($id);
    $comapany->email = $request->email;
    if($request->password){
      $comapany->password = Hash::make($request->password);
      $comapany->last_update_by = $id;
    }
    $comapany->language = $request->language;
    $comapany->save();

    return response()->json([
      'status' => true,
    ],200);
  }
}
