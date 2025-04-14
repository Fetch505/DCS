<?php

namespace App\Http\Controllers\Common;

use ApiPostcode\Client\PostcodeClient;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Postcode;
use Session;
use Hash;
use Auth;
use App;
use DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $customers = Customer::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.customer.index')->withCustomers($customers);
    }

    public function sup_index()
    {
        // dd('here');
      $customers = Customer::all();
      return view('Super_Admin.customer.index')->withCustomers($customers);
    }

    public function getAddressFromPostCode(Request $request)
    {
      $postcode = $request->postcode;
      $houseNumber = $request->houseNumber;
      $token = '66793ff3-67a1-4b88-8ae0-53aedbb67bf7';
      $client = new PostcodeClient($token);
      $address = $client->fetchAddress($postcode, $houseNumber);
      return response()->json([
        'status' => true,
        'address' => $address
      ],200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.customer.add');
    }

    public function sup_create()
    {
        return view('Super_Admin.customer.add');
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
        'phone' => 'required',
        'address' => 'required|max:255',
        //'postcode' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
        'city' => 'required|max:255',
        //'houseNumber' => 'required|max:255',
        'country' => 'required|max:255',
        'password' => 'required|min:6|max:255',
        ]);
      $company_id = Auth::id();
      $role = DB::table('roles')->where('name','=','customer')->first();
      $company = DB::table('users')->where('id','=',Auth::user()->id)->first();

      $user                 = new User;
      $user->name           = $request->name;
      $user->email          = $request->email;
      $user->slug           = Str::slug($user->name) . '-' . time();
      $user->phone          = $request->phone;
      $user->company_id     = $company->company_id;
      $user->worker_type_id = null;
      $user->role_id        = $role->id;
      $user->company_id     = $company_id;
      $user->address        = $request->address;
      $user->city           = $request->city;
      $user->zipcode        = $request->zipcode;
      $user->postcode       = $request->postcode;
      $user->houseNumber    = $request->houseNumber;
      $user->country        = $request->country;
      $user->postcode       = $request->postcode;
      $user->fax            = $request->fax;
      $user->contact_person1 = $request->contact_person1;
      $user->contact_person2 = $request->contact_person2;
      $user->notes          = null;
      $user->password       = Hash::make($request->password);
      $user->created_at     = carbon::now();
      $user->updated_at     = carbon::now();
      $user->save();

      $customer = new Customer;
      $customer->name = $request->name;
      $customer->slug = Str::slug($customer->name) . '-' . time();
      $customer->user_id = $user->id;
      $customer->company_id = Auth::id();
      $customer->mailbox = $request->mailbox;
      $customer->mailbox_city = $request->mailbox_city;
      $customer->mailbox_zip = $request->mailbox_zip;
      $customer->created_at = carbon::now();
      $customer->updated_at = carbon::now();
      $customer->save();

      if (App::getLocale() == "en") {
           Session::flash('success','Customer added successfully');
      }else {
        Session::flash('success','Klant toegevoegd Succesvol');
      }

      return response()->json([
        'status' => true,
        'message' => "Success"
      ],200);

      // if (Auth::user()->role_id == 1) {
      //    return redirect()->route('sup_customer.index');
      // }
      // else {
      //     return redirect()->route('customer.index');
      // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('Company_Admin.customer.view')->withCustomer($customer);
    }

    public function sup_show(Customer $customer)
    {
        return view('Super_Admin.customer.view')->withCustomer($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('Company_Admin.customer.edit')->withCustomer($customer);
    }

    public function sup_edit(Customer $customer)
    {
        // $customer = Customer::find($id);
        return view('Super_Admin.customer.edit')->withCustomer($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
      $request->validate([
        'name' => 'required|max:255',
        'email' => "required|email|unique:users,email,$customer->user_id",
        'phone' => 'required',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
        'country' => 'required|max:255',
        //'postcode' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
        ]);

      $role = DB::table('roles')->where('name','=','customer')->first();
      $company = DB::table('users')->where('id','=',Auth::user()->id)->first();


      $user = User::where('id','=',$customer->user_id)->first();
      // dd($user);
      $user->name           = $request->name;
      $user->email          = $request->email;
      $user->phone          = $request->phone;
      $user->address        = $request->address;
      $user->company_id     = Auth::user()->id;
      $user->city           = $request->city;
      $user->zipcode        = $request->zipcode;
      $user->country        = $request->country;
      $user->postcode       = $request->postcode;
      $user->fax            = $request->fax;
      $user->contact_person1 = $request->contact_person1;
      $user->contact_person2 = $request->contact_person2;
      $user->updated_at     = carbon::now();
      $user->save();

      $customer->name           = $request->name;
      $customer->mailbox        = $request->mailbox;
      $customer->mailbox_city   = $request->mailbox_city;
      $customer->mailbox_zip    = $request->mailbox_zip;
      $customer->updated_at     = carbon::now();
      $customer->save();

      if (App::getLocale() == "en") {
           Session::flash('success','Customer updated successfully');
      }else {
        Session::flash('success','Klant succesvol bijgewerkt');
      }

      if (Auth::user()->role_id == 1) {
         return redirect()->route('sup_customer.index');
      }
      else {
          return redirect()->route('customer.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function deleteRecord(Customer $customer)
    {
      User::where('id','=',$customer->user_id)->delete();
      $customer->delete();

      if (App::getLocale() == "en") {
           Session::flash('success','Customer deleted successfully');
      }else {
        Session::flash('success','Klant verwijderd succesvol');
      }
      return redirect()->route('customer.index');
    }
}
