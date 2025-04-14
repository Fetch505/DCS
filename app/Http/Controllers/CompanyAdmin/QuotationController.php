<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use PDF;
use Auth;
use Session;
use App\Models\Quotation;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Mail\QuotationPDFMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\QuotationRequest;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with('items')->latest()->get();
        return view('Company_Admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        $company_id = Auth::id();
        $workerTypes = WorkerType::where('company_id', '=', $company_id)->select('name','id')->get();
        return view('Company_Admin.quotations.add', compact('workerTypes')); 
    }

    public function store(QuotationRequest $request)
    {
        $validatedData = $request->validated();

        $company_id = Auth::id();
        $quotation = Quotation::create($validatedData['quotation']);

        // Create quotation items
        $quotation->items()->createMany($validatedData['items']);

        return response()->json([
            'redirectUrl' => route('quotations.index'),
            'success' => 'Quotation created successfully.'
        ],200);
    }

    public function show(Quotation $quotation)
    {
        $quotation = $quotation->load('items.workerType');
        // dd($quotation);
        return view('Company_Admin.quotations.view')->withQuotation($quotation);
    }

    public function sendQuotationPDF($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotationPDF = PDF::loadView('Company_Admin.quotations.pdf', ['quotation' => $quotation]);

        Mail::to('example@gmail.com')->send(new QuotationPDFMail($quotationPDF));
        return redirect()->back()->with('success', 'Quotation PDF sent successfully');
    }

     /**
     * Show the form for editing the specified quotation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $company_id = Auth::id();
        $quotation = $quotation->load('items');
        $workerTypes = WorkerType::where('company_id', '=', $company_id)->select('name','id')->get();
        return view('Company_Admin.quotations.edit', compact('quotation','workerTypes')); 
    }

    public function update(QuotationRequest $request, Quotation $quotation)
    {
        $validatedData = $request->validated();

        $quotation->update($validatedData['quotation']);

        // Update existing quotation items and add new ones
        foreach ($validatedData['items'] as $itemData) {
            if (isset($itemData['id'])) {
                // If the item has an ID, it's an existing item
                $item = $quotation->items()->findOrFail($itemData['id']);
                $item->update($itemData);
            } else {
                // If the item doesn't have an ID, it's a new item
                $quotation->items()->create($itemData);
            }
        }

        return response()->json([
            'redirectUrl' => route('quotations.index'),
            'success' => 'Quotation updated successfully.'
        ], 200);
    }


}