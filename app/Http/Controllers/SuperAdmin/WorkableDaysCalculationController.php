<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\WorkableDaysCalculation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkableDaysCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $workableDays = WorkableDaysCalculation::all();
      return view('Super_Admin.WorkableDays.index')
              ->withWorkableDays($workableDays);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.WorkableDays.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = date('Y');

        $check = WorkableDaysCalculation::where('year','=',$year)->first();

        if(empty($check)){
            $workableDay_cal = new WorkableDaysCalculation;
            $workableDay_cal->year = $year;

            $workableDay_cal->number_of_calendar_days = $request->workableDays['number_of_calendar_days'];
            $workableDay_cal->weekend_days = $request->workableDays['weekend_days'];
            $workableDay_cal->work_days_a_year = $request->workableDays['work_days_a_year'];
            $workableDay_cal->nat_holydays_short_absence_bijz_CAO_value = $request->workableDays['nat_holydays_short_absence_bijz_CAO_value'];
            $workableDay_cal->holidays_value = $request->workableDays['holidays_value'];
            $workableDay_cal->sickdays_value = $request->workableDays['sickdays_value'];
            $workableDay_cal->frost_days_off = $request->workableDays['frost_days_off'];
            $workableDay_cal->workable_days_a_year = $request->workableDays['workable_days_a_year'];
            $workableDay_cal->nat_holydays_short_absence_bijz_CAO_percent = $request->workableDays['nat_holydays_short_absence_bijz_CAO_percent'];
            $workableDay_cal->holidays_percent = $request->workableDays['holidays_percent'];
            $workableDay_cal->sickdays_percent = $request->workableDays['sickdays_percent'];
            $workableDay_cal->rage_unworkable_days_in_percent = $request->workableDays['rage_unworkable_days_in_percent'];
            $workableDay_cal->save();

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
     * @param  \App\WorkableDaysCalculation  $workableDaysCalculation
     * @return \Illuminate\Http\Response
     */
    public function show(WorkableDaysCalculation $workableDaysCalculation)
    {
        return view('Super_Admin.WorkableDays.view')
        ->withId($workableDaysCalculation->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkableDaysCalculation  $workableDaysCalculation
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkableDaysCalculation $workableDaysCalculation)
    {
        return view('Super_Admin.WorkableDays.edit')
        ->withId($workableDaysCalculation->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkableDaysCalculation  $workableDaysCalculation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkableDaysCalculation $workableDaysCalculation)
    {

        $workableDaysCalculation->number_of_calendar_days = $request->workableDays['number_of_calendar_days'];
        $workableDaysCalculation->weekend_days = $request->workableDays['weekend_days'];
        $workableDaysCalculation->work_days_a_year = $request->workableDays['work_days_a_year'];
        $workableDaysCalculation->nat_holydays_short_absence_bijz_CAO_value = $request->workableDays['nat_holydays_short_absence_bijz_CAO_value'];
        $workableDaysCalculation->holidays_value = $request->workableDays['holidays_value'];
        $workableDaysCalculation->sickdays_value = $request->workableDays['sickdays_value'];
        $workableDaysCalculation->frost_days_off = $request->workableDays['frost_days_off'];
        $workableDaysCalculation->workable_days_a_year = $request->workableDays['workable_days_a_year'];
        $workableDaysCalculation->nat_holydays_short_absence_bijz_CAO_percent = $request->workableDays['nat_holydays_short_absence_bijz_CAO_percent'];
        $workableDaysCalculation->holidays_percent = $request->workableDays['holidays_percent'];
        $workableDaysCalculation->sickdays_percent = $request->workableDays['sickdays_percent'];
        $workableDaysCalculation->rage_unworkable_days_in_percent = $request->workableDays['rage_unworkable_days_in_percent'];
        $workableDaysCalculation->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkableDaysCalculation  $workableDaysCalculation
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkableDaysCalculation $workableDaysCalculation)
    {
        //
    }

    public function workableDaysDetail(WorkableDaysCalculation $workableDaysCalculation)
    {
        return response()->json([
            'workableDays' => $workableDaysCalculation,
        ]);
    }
}
