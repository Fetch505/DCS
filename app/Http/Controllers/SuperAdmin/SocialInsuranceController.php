<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SocialInsurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hourlyRateIndex()
    {
        return view('Super_Admin.HourlyRate.index');
    }

    public function index()
    {
        $socialInsurances = SocialInsurance::all();
        return view('Super_Admin.SocialInsurance.index')
                ->withSocialInsurances($socialInsurances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.SocialInsurance.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request->social_insurance,[
        //     'WAO_basic_prize'  =>  'required',
        //     'WAO_calculateprize'  =>  'required',
        //     'WGA_calculateprize'  =>  'required',
        //     'total_prize_PEMBA_IVA'  =>  'required',
        //     'Unemploymentlaw_ww1'  =>  'required',
        //     'Redundancy_fund_incl_childcare'  =>  'required',
        //     'Healtcarelaw'  =>  'required',
        //     'Pre_pension'  =>  'required',
        //     'AOP_p'  =>  'required',
        //     'OP_NP_pension_2'  =>  'required',
        //     'Pension_transitional_arrangement'  =>  'required',
        //     'VUT_transitional_arrangement'  =>  'required',
        //     'Final_levy_VUT_transitional_arrangement'  =>  'required',
        //     'O_R_zie_RAS_heffing'  =>  'required',
        //     'Childcare_zie_resdundancy_fund'  =>  'required',
        //     'RAS_charge'  =>  'required',
        //     'Totaal_prize_divers'  =>  'required',
        //     'Totaal_sociale_insurances'  =>  'required',
        // ]);
        $year = date("Y");
        $check = SocialInsurance::where('year','=',$year)->first();

        if(empty($check)){
            $s_insurance = new SocialInsurance;
            $s_insurance->year = $year;
            $s_insurance->WAO_basic_prize = $request->social_insurance['WAO_basic_prize'];
            $s_insurance->WAO_calculateprize = $request->social_insurance['WAO_calculateprize'];
            $s_insurance->WGA_calculateprize = $request->social_insurance['WGA_calculateprize'];
            $s_insurance->total_prize_PEMBA_IVA = $request->social_insurance['total_prize_PEMBA_IVA'];
            $s_insurance->Unemploymentlawww_1 = $request->social_insurance['Unemploymentlaw_ww1'];
            $s_insurance->Redundancy_fund_incl_childcare = $request->social_insurance['Redundancy_fund_incl_childcare'];
            $s_insurance->Healtcarelaw = $request->social_insurance['Healtcarelaw'];
            $s_insurance->Pre_pension = $request->social_insurance['Pre_pension'];
            $s_insurance->AOP_p = $request->social_insurance['AOP_p'];
            $s_insurance->OP_NP_pension_2 = $request->social_insurance['OP_NP_pension_2'];
            $s_insurance->Pension_transitional_arrangement = $request->social_insurance['Pension_transitional_arrangement'];
            $s_insurance->VUT_transitional_arrangement = $request->social_insurance['VUT_transitional_arrangement'];
            $s_insurance->Final_levy_VUT_transitional_arrangement = $request->social_insurance['Final_levy_VUT_transitional_arrangement'];
            $s_insurance->O_R_zie_RAS_heffing = $request->social_insurance['O_R_zie_RAS_heffing'];
            $s_insurance->Childcare_zie_resdundancy_fund = $request->social_insurance['Childcare_zie_resdundancy_fund'];
            $s_insurance->RAS_charge = $request->social_insurance['RAS_charge'];
            $s_insurance->Totaal_prize_divers = $request->social_insurance['Totaal_prize_divers'];
            $s_insurance->Totaal_sociale_insurances = $request->social_insurance['Totaal_sociale_insurances'];

            $s_insurance->save();
            $status = true;
        }else {
            $status = false;
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialInsurance  $socialInsurance
     * @return \Illuminate\Http\Response
     */
    public function show(SocialInsurance $socialInsurance)
    {
        return view('Super_Admin.SocialInsurance.view')
                ->withId($socialInsurance->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialInsurance  $socialInsurance
     * @return \Illuminate\Http\Response
     */

    public function edit(SocialInsurance $socialInsurance)
    {
        return view('Super_Admin.SocialInsurance.edit')
                ->withId($socialInsurance->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialInsurance  $socialInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialInsurance $socialInsurance)
    {
        $s_insurance = SocialInsurance::find($request->id);

        $s_insurance->WAO_basic_prize = $request->social_insurance['WAO_basic_prize'];
        $s_insurance->WAO_calculateprize = $request->social_insurance['WAO_calculateprize'];
        $s_insurance->WGA_calculateprize = $request->social_insurance['WGA_calculateprize'];
        $s_insurance->total_prize_PEMBA_IVA = $request->social_insurance['total_prize_PEMBA_IVA'];
        $s_insurance->Unemploymentlawww_1 = $request->social_insurance['Unemploymentlaw_ww1'];
        $s_insurance->Redundancy_fund_incl_childcare = $request->social_insurance['Redundancy_fund_incl_childcare'];
        $s_insurance->Healtcarelaw = $request->social_insurance['Healtcarelaw'];
        $s_insurance->Pre_pension = $request->social_insurance['Pre_pension'];
        $s_insurance->AOP_p = $request->social_insurance['AOP_p'];
        $s_insurance->OP_NP_pension_2 = $request->social_insurance['OP_NP_pension_2'];
        $s_insurance->Pension_transitional_arrangement = $request->social_insurance['Pension_transitional_arrangement'];
        $s_insurance->VUT_transitional_arrangement = $request->social_insurance['VUT_transitional_arrangement'];
        $s_insurance->Final_levy_VUT_transitional_arrangement = $request->social_insurance['Final_levy_VUT_transitional_arrangement'];
        $s_insurance->O_R_zie_RAS_heffing = $request->social_insurance['O_R_zie_RAS_heffing'];
        $s_insurance->Childcare_zie_resdundancy_fund = $request->social_insurance['Childcare_zie_resdundancy_fund'];
        $s_insurance->RAS_charge = $request->social_insurance['RAS_charge'];
        $s_insurance->Totaal_prize_divers = $request->social_insurance['Totaal_prize_divers'];
        $s_insurance->Totaal_sociale_insurances = $request->social_insurance['Totaal_sociale_insurances'];

        $s_insurance->save();
        $status = true;

        return response()->json([
            'status' => $status,
            'socialInsurance' => $socialInsurance,
            'request' => $request->all(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialInsurance  $socialInsurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialInsurance $socialInsurance)
    {
        //
    }


    public function insuranceDetail($id)
    {
        $socialInsurance = SocialInsurance::find($id);
        return response()->json([
            'socialInsurance' => $socialInsurance,
        ]);
    }
}
