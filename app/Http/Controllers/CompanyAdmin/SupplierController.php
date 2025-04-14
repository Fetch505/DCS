<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::id();
        $suppliers = Supplier::where('company_id', '=', $company_id)->get();
        return view('Company_Admin.supplier.index')->withSuppliers($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company_Admin.supplier.add');
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
          'contact' => 'required|max:255',
          'address' => 'required|max:255',
          'email' => 'required|email',
          ]);

        $company_id = Auth::id();
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact = $request->contact;
        $supplier->address = $request->address;
        $supplier->company_id = $company_id;
        $supplier->save();

        Session::flash('success','Supplier added Successfuly');
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('Company_Admin.supplier.edit')->withSupplier($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
      $request->validate([
        'name' => 'required|max:255',
        'contact' => 'required|max:255',
        'address' => 'required|max:255',
        'email' => 'required|email',
        ]);

      $supplier->name = $request->name;
      $supplier->email = $request->email;
      $supplier->contact = $request->contact;
      $supplier->address = $request->address;
      $supplier->save();

      Session::flash('success','Supplier info updated Successfuly');
      return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {

    }

    public function deleteRecord(Supplier $supplier)
    {
      $supplier->materials()->detach();
      $supplier->delete();
      Session::flash('success','Supplier info deleted Successfuly');
      return redirect()->route('supplier.index');
    }
}
