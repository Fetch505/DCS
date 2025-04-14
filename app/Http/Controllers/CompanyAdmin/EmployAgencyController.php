<?php

namespace App\Http\Controllers\CompanyAdmin;

use App;
use Auth;
use App\Models\EmployAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;

class EmployAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $agencies   = EmployAgency::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.employ_agency.index')->withAgencies($agencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.employ_agency.add');
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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employ_agencies,email',
        // 'url' => 'required|url|max:255',
        'contact_person' => 'required|string|max:255',
        'phone' => 'required',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
        'zipcode' => 'max:255',
        //'postcode' => 'required',
        //'houseNumber' => 'required',
        'country' => 'required|max:255',
        'fax' => 'max:255',
        ],[
            'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxxxx).'
        ]);

      $agency = new EmployAgency;
      $agency->email = $request->email;
      $agency->company_id = Auth::id();
      $agency->name = $request->name;
      $agency->slug = Str::slug($request->name) . '-' . time();
      $agency->url = $request->url;
      $agency->contact_person = $request->contact_person;
      $agency->phone = $request->phone;
      $agency->address = $request->address;
      $agency->postcode = $request->postcode;
      $agency->houseNumber = $request->houseNumber;
      $agency->city = $request->city;
      $agency->zipcode = $request->zipcode;
      $agency->country = $request->country;
      $agency->fax = $request->fax;
      $agency->notes = null;
      $agency->created_at = carbon::now();
      $agency->updated_at = carbon::now();
      $agency->save();

      return response()->json([
              'message' => 'success',
              'status'  => 1
          ], 200);
      // Session::flash('success','Employment Agency added Successfuly (Agency Successfuly toegevoegd)');
      // return redirect()->route('employ_agency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployAgency  $employAgency
     * @return \Illuminate\Http\Response
     */
    public function show(EmployAgency $employAgency)
    {
        return view('Company_Admin.employ_agency.view')->withEmployAgency($employAgency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployAgency  $employAgency
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployAgency $employAgency)
    {
        return view('Company_Admin.employ_agency.edit')->withEmployAgency($employAgency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployAgency  $employAgency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployAgency $employAgency)
    {
      $request->validate([
        'name' => 'required|max:255',
        // 'url' => 'required|url|max:255',
        'email' => "required|email|unique:employ_agencies,email,$employAgency->id",
        'contact_person' => 'required|string|max:255',
        'phone' => 'required',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
        'zipcode' => 'max:255',
        //'postcode' => 'required',
        //'houseNumber' => 'required',
        'country' => 'required|max:255',
        'fax' => 'max:255',
        ],[
            'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxx).'
        ]);

      $employAgency->name = $request->name;
      $employAgency->email = $request->email;
      $employAgency->url = $request->url;
      $employAgency->contact_person = $request->contact_person;
      $employAgency->phone = $request->phone;
      $employAgency->address = $request->address;
      $employAgency->city = $request->city;
      $employAgency->postcode = $request->postcode;
      $employAgency->houseNumber = $request->houseNumber;
      $employAgency->zipcode = $request->zipcode;
      $employAgency->country = $request->country;
      $employAgency->fax = $request->fax;
      $employAgency->updated_at = carbon::now();
      $employAgency->save();

      if (App::getLocale() == "en") {
        Session::flash('success','Employment agency info updated successfully');
      }else {
        Session::flash('success','Agentschap info succesvol bewerkt');
      }

      return redirect()->route('employ_agency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployAgency  $employAgency
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployAgency $employAgency)
    {
        //
    }

    public function deleteRecord(EmployAgency $employAgency)
    {
      $employAgency->delete();

      if (App::getLocale() == "en") {
        Session::flash('success','Employment agency deleted successfully');
      }else {
        Session::flash('success','Agentschap verwijderd');
      }

      return redirect()->route('employ_agency.index');
    }
}
