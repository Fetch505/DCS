<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Hash;
use DB;

use Carbon\Carbon;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $companies = Company::with('users')->get();
      $company_admin = Role::where('name','=','admin')->pluck('id')->first();
      $companies = User::where('role_id','=',$company_admin)->get();

      $active_companies = User::where('is_active', '=', '1')->count();
      $inactive_companies = User::where('is_active', '=', '0')->count();
     
      // return view('Super_Admin.companies.index')->withCompanies($companies);
      return view('Super_Admin.companies.index')->with([
        'companies'           => $companies,
        'active_companies'    => $active_companies,
        'inactive_companies'  => $inactive_companies,

      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.companies.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request->all();
      $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'required',
        'contact_person' => 'required',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
        'postcode' => 'required|max:255',
        'houseNumber' => 'required|max:255',
        'country' => 'required|max:255',
        ]);

      $company = new Company;
      $company->name = $request->name;
      $company->save();

      $role_id              = Role::where('name','=','admin')->pluck('id')->first();
      $user                 = new User;
      $user->role_id        = $role_id;
      $user->email          = $request->email;
      $user->name           = $request->name;
      $user->password       = Hash::make($request->password);
      $user->slug           = Str::slug($request->name) . '-' . time();
      $user->phone          = $request->phone;
      $user->company_id     = $company->id;
      $user->worker_type_id = 0;
      $user->address        = $request->address;
      $user->city           = $request->city;
      $user->contact_person1 = $request->contact_person;
      $user->zipcode        = $request->zipcode;
      $user->postcode       = $request->postcode;
      $user->houseNumber    = $request->houseNumber;
      $user->country        = $request->country;
      $user->fax            = $request->fax;
      $user->allow_leaves   = (isset($request->allow_leaves))? 1:0;
      $user->is_active      = (isset($request->is_active))? 1:0;
      $user->notes          = null;
      $user->email_verified_at = null;
      $user->created_at     = carbon::now();
      $user->updated_at     = carbon::now();
      $user->save();

      //send welcome email to the company_id
      Mail::to($request->email)->send(new WelcomeMail($request->name));

      return response()->json([
          'status' => true,
          'errors' => false,
      ],200);
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
       $company = User::findOrFail($id);
       return view('Super_Admin.companies.edit')->withCompany($company);
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
        'phone' => 'required',
        'contact_person1' => 'required',
        'address' => 'required|max:255',
        'password' => $request->password ? 'required|min:5' : '',
        'city' => 'required|max:255',
        'country' => 'required|max:255',
        ]);

      $user = User::findOrFail($id);
      DB::table('companies')
            ->where('id', $user->company_id)
            ->update(['name' => $request->name]);

        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->phone          = $request->phone;
        $user->address        = $request->address;
        $user->contact_person1 = $request->contact_person1;
        $user->city           = $request->city;
        $user->zipcode        = $request->zipcode;
        $user->password       = $request->password ? Hash::make($request->password) : $user->password;
        $user->postcode       = $request->postcode;
        $user->houseNumber    = $request->houseNumber;
        $user->country        = $request->country;
        $user->fax            = $request->fax;
        $user->allow_leaves   = (isset($request->allow_leaves))? 1:0;
        $user->is_active      = (isset($request->is_active))? 1:0;
        $user->save();            
        

      return redirect()->route('supadmin.companiesIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       //first delete all linked workers with it
       User::where('company_id','=',$id)->delete();
       $user = User::findOrFail($id);
       Company::where('id','=',$user->company_id)->delete();
       $user->delete();
       return redirect()->route('supadmin.companiesIndex')->with('status', trans('common.delete_company'));
     }
}
