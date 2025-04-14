<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\EmployeeGroup;
use App\Models\SocialInsurance;
use App\Models\WorkableDaysCalculation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $employeeGroups = EmployeeGroup::all();
      return view('Super_Admin.EmployeeGroup.index')
              ->withEmployeeGroups($employeeGroups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.EmployeeGroup.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group_name = $request->employeeGroup['group_name'];
        $check = EmployeeGroup::where('name','=',$group_name)->first();

        if (empty($check)) {
            $emp_group = new EmployeeGroup;
            $emp_group->name = $request->employeeGroup['group_name'];
            $emp_group->basic_hour_rate = $request->employeeGroup['basic_hour_rate'];
            $emp_group->end_year_allowence_percent = $request->employeeGroup['end_year_allowence_percent'];
            $emp_group->end_year_allowence_value = $request->employeeGroup['end_year_allowence_value'];
            $emp_group->holiday_allowence_percent = $request->employeeGroup['holiday_allowence_percent'];
            $emp_group->holiday_allowence_value = $request->employeeGroup['holiday_allowence_value'];
            $emp_group->gross_hour_wage = $request->employeeGroup['gross_hour_wage'];
            $emp_group->gross_wage_including_allowaence = $request->employeeGroup['gross_wage_including_allowaence'];
            $emp_group->social_insurance_premiums_percent = $request->employeeGroup['social_insurance_premiums_percent'];
            $emp_group->social_insurance_premiums_value = $request->employeeGroup['social_insurance_premiums_value'];
            $emp_group->subtotal_wage_costs_per_hour_1 = $request->employeeGroup['subtotal_wage_costs_per_hour_1'];
            $emp_group->nationale_holidays_percent = $request->employeeGroup['nationale_holidays_percent'];
            $emp_group->nationale_holidays_value = $request->employeeGroup['nationale_holidays_value'];
            $emp_group->holidays_percent = $request->employeeGroup['holidays_percent'];
            $emp_group->holidays_value = $request->employeeGroup['holidays_value'];
            $emp_group->costs_absenteeism_percent = $request->employeeGroup['costs_absenteeism_percent'];
            $emp_group->costs_absenteeism_value = $request->employeeGroup['costs_absenteeism_value'];
            $emp_group->subtotal_wage_costs_per_hour = $request->employeeGroup['subtotal_wage_costs_per_hour'];
            $emp_group->total_wage_costs_per_hour = $request->employeeGroup['total_wage_costs_per_hour'];
            $emp_group->material_en_recorses_machines_percent = $request->employeeGroup['material_en_recorses_machines_percent'];
            $emp_group->material_en_recorses_machines_value = $request->employeeGroup['material_en_recorses_machines_value'];
            $emp_group->workclothing_en_equipment_percent = $request->employeeGroup['workclothing_en_equipment_percent'];
            $emp_group->workclothing_en_equipment_value = $request->employeeGroup['workclothing_en_equipment_value'];
            $emp_group->total_direct_costs = $request->employeeGroup['total_direct_costs'];
            $emp_group->indirectly_supervision_managementcosts_percent = $request->employeeGroup['indirectly_supervision_managementcosts_percent'];
            $emp_group->indirectly_supervision_managementcosts_value =
            $request->employeeGroup['indirectly_supervision_managementcosts_value'];
            $emp_group->education_training_percent = $request->employeeGroup['education_training_percent'];
            $emp_group->education_training_value = $request->employeeGroup['education_training_value'];
            $emp_group->companycosts_administration_housing_costs_percent = $request->employeeGroup['companycosts_administration_housing_costs_percent'];
            $emp_group->companycosts_administration_housing_costs_value = $request->employeeGroup['companycosts_administration_housing_costs_value'];
            $emp_group->reis_auto_kosten_overige_percent = $request->employeeGroup['reis_auto_kosten_overige_percent'];
            $emp_group->reis_auto_kosten_overige_value = $request->employeeGroup['reis_auto_kosten_overige_value'];
            $emp_group->total_indirecte_costs = $request->employeeGroup['total_indirecte_costs'];
            $emp_group->risk_and_profit_percent = $request->employeeGroup['risk_and_profit_percent'];
            $emp_group->risk_and_profit_value = $request->employeeGroup['risk_and_profit_value'];
            $emp_group->total_end_wage_normale_workhours_06_to_21 = $request->employeeGroup['total_end_wage_normale_workhours_06_to_21'];
            $emp_group->total_endwage_weekend_incl_50_toeslag = $request->employeeGroup['total_endwage_weekend_incl_50_toeslag'];
            $emp_group->total_endwage_holidays_incl_150_toeslag = $request->employeeGroup['total_endwage_holidays_incl_150_toeslag'];
            $emp_group->marge_loonkosten_eindtarief = $request->employeeGroup['marge_loonkosten_eindtarief'];
            $emp_group->save();

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
     * @param  \App\EmployeeGroup  $employeeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeGroup $employeeGroup)
    {
        $id = $employeeGroup->id;
        return view('Super_Admin.EmployeeGroup.view')->withId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeGroup  $employeeGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeGroup $employeeGroup)
    {
        $id = $employeeGroup->id;
        return view('Super_Admin.EmployeeGroup.edit')->withId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeGroup  $employeeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeGroup $employeeGroup)
    {
        $status = false;
        $group_name = $request->employeeGroup['group_name'];
        $check = EmployeeGroup::where('name','=',$group_name)->first();

        if (empty($check->id)) { // incase when only changes group name
                $emp_group =  EmployeeGroup::find($request->id);
                $emp_group->name = $request->employeeGroup['group_name'];
                $emp_group->basic_hour_rate = $request->employeeGroup['basic_hour_rate'];
                $emp_group->end_year_allowence_percent = $request->employeeGroup['end_year_allowence_percent'];
                $emp_group->end_year_allowence_value = $request->employeeGroup['end_year_allowence_value'];
                $emp_group->holiday_allowence_percent = $request->employeeGroup['holiday_allowence_percent'];
                $emp_group->holiday_allowence_value = $request->employeeGroup['holiday_allowence_value'];
                $emp_group->gross_hour_wage = $request->employeeGroup['gross_hour_wage'];
                $emp_group->gross_wage_including_allowaence = $request->employeeGroup['gross_wage_including_allowaence'];
                $emp_group->social_insurance_premiums_percent = $request->employeeGroup['social_insurance_premiums_percent'];
                $emp_group->social_insurance_premiums_value = $request->employeeGroup['social_insurance_premiums_value'];
                $emp_group->subtotal_wage_costs_per_hour_1 = $request->employeeGroup['subtotal_wage_costs_per_hour_1'];
                $emp_group->nationale_holidays_percent = $request->employeeGroup['nationale_holidays_percent'];
                $emp_group->nationale_holidays_value = $request->employeeGroup['nationale_holidays_value'];
                $emp_group->holidays_percent = $request->employeeGroup['holidays_percent'];
                $emp_group->holidays_value = $request->employeeGroup['holidays_value'];
                $emp_group->costs_absenteeism_percent = $request->employeeGroup['costs_absenteeism_percent'];
                $emp_group->costs_absenteeism_value = $request->employeeGroup['costs_absenteeism_value'];
                $emp_group->subtotal_wage_costs_per_hour = $request->employeeGroup['subtotal_wage_costs_per_hour'];
                $emp_group->total_wage_costs_per_hour = $request->employeeGroup['total_wage_costs_per_hour'];
                $emp_group->material_en_recorses_machines_percent = $request->employeeGroup['material_en_recorses_machines_percent'];
                $emp_group->material_en_recorses_machines_value = $request->employeeGroup['material_en_recorses_machines_value'];
                $emp_group->workclothing_en_equipment_percent = $request->employeeGroup['workclothing_en_equipment_percent'];
                $emp_group->workclothing_en_equipment_value = $request->employeeGroup['workclothing_en_equipment_value'];
                $emp_group->total_direct_costs = $request->employeeGroup['total_direct_costs'];
                $emp_group->indirectly_supervision_managementcosts_percent = $request->employeeGroup['indirectly_supervision_managementcosts_percent'];
                $emp_group->indirectly_supervision_managementcosts_value =
                $request->employeeGroup['indirectly_supervision_managementcosts_value'];
                $emp_group->education_training_percent = $request->employeeGroup['education_training_percent'];
                $emp_group->education_training_value = $request->employeeGroup['education_training_value'];
                $emp_group->companycosts_administration_housing_costs_percent = $request->employeeGroup['companycosts_administration_housing_costs_percent'];
                $emp_group->companycosts_administration_housing_costs_value = $request->employeeGroup['companycosts_administration_housing_costs_value'];
                $emp_group->reis_auto_kosten_overige_percent = $request->employeeGroup['reis_auto_kosten_overige_percent'];
                $emp_group->reis_auto_kosten_overige_value = $request->employeeGroup['reis_auto_kosten_overige_value'];
                $emp_group->total_indirecte_costs = $request->employeeGroup['total_indirecte_costs'];
                $emp_group->risk_and_profit_percent = $request->employeeGroup['risk_and_profit_percent'];
                $emp_group->risk_and_profit_value = $request->employeeGroup['risk_and_profit_value'];
                $emp_group->total_end_wage_normale_workhours_06_to_21 = $request->employeeGroup['total_end_wage_normale_workhours_06_to_21'];
                $emp_group->total_endwage_weekend_incl_50_toeslag = $request->employeeGroup['total_endwage_weekend_incl_50_toeslag'];
                $emp_group->total_endwage_holidays_incl_150_toeslag = $request->employeeGroup['total_endwage_holidays_incl_150_toeslag'];
                $emp_group->marge_loonkosten_eindtarief = $request->employeeGroup['marge_loonkosten_eindtarief'];
                $emp_group->save();
                $status = true;
        }else if($check->id == $request->id){
            $emp_group =  EmployeeGroup::find($request->id);
            $emp_group->name = $request->employeeGroup['group_name'];
            $emp_group->basic_hour_rate = $request->employeeGroup['basic_hour_rate'];
            $emp_group->end_year_allowence_percent = $request->employeeGroup['end_year_allowence_percent'];
            $emp_group->end_year_allowence_value = $request->employeeGroup['end_year_allowence_value'];
            $emp_group->holiday_allowence_percent = $request->employeeGroup['holiday_allowence_percent'];
            $emp_group->holiday_allowence_value = $request->employeeGroup['holiday_allowence_value'];
            $emp_group->gross_hour_wage = $request->employeeGroup['gross_hour_wage'];
            $emp_group->gross_wage_including_allowaence = $request->employeeGroup['gross_wage_including_allowaence'];
            $emp_group->social_insurance_premiums_percent = $request->employeeGroup['social_insurance_premiums_percent'];
            $emp_group->social_insurance_premiums_value = $request->employeeGroup['social_insurance_premiums_value'];
            $emp_group->subtotal_wage_costs_per_hour_1 = $request->employeeGroup['subtotal_wage_costs_per_hour_1'];
            $emp_group->nationale_holidays_percent = $request->employeeGroup['nationale_holidays_percent'];
            $emp_group->nationale_holidays_value = $request->employeeGroup['nationale_holidays_value'];
            $emp_group->holidays_percent = $request->employeeGroup['holidays_percent'];
            $emp_group->holidays_value = $request->employeeGroup['holidays_value'];
            $emp_group->costs_absenteeism_percent = $request->employeeGroup['costs_absenteeism_percent'];
            $emp_group->costs_absenteeism_value = $request->employeeGroup['costs_absenteeism_value'];
            $emp_group->subtotal_wage_costs_per_hour = $request->employeeGroup['subtotal_wage_costs_per_hour'];
            $emp_group->total_wage_costs_per_hour = $request->employeeGroup['total_wage_costs_per_hour'];
            $emp_group->material_en_recorses_machines_percent = $request->employeeGroup['material_en_recorses_machines_percent'];
            $emp_group->material_en_recorses_machines_value = $request->employeeGroup['material_en_recorses_machines_value'];
            $emp_group->workclothing_en_equipment_percent = $request->employeeGroup['workclothing_en_equipment_percent'];
            $emp_group->workclothing_en_equipment_value = $request->employeeGroup['workclothing_en_equipment_value'];
            $emp_group->total_direct_costs = $request->employeeGroup['total_direct_costs'];
            $emp_group->indirectly_supervision_managementcosts_percent = $request->employeeGroup['indirectly_supervision_managementcosts_percent'];
            $emp_group->indirectly_supervision_managementcosts_value =
            $request->employeeGroup['indirectly_supervision_managementcosts_value'];
            $emp_group->education_training_percent = $request->employeeGroup['education_training_percent'];
            $emp_group->education_training_value = $request->employeeGroup['education_training_value'];
            $emp_group->companycosts_administration_housing_costs_percent = $request->employeeGroup['companycosts_administration_housing_costs_percent'];
            $emp_group->companycosts_administration_housing_costs_value = $request->employeeGroup['companycosts_administration_housing_costs_value'];
            $emp_group->reis_auto_kosten_overige_percent = $request->employeeGroup['reis_auto_kosten_overige_percent'];
            $emp_group->reis_auto_kosten_overige_value = $request->employeeGroup['reis_auto_kosten_overige_value'];
            $emp_group->total_indirecte_costs = $request->employeeGroup['total_indirecte_costs'];
            $emp_group->risk_and_profit_percent = $request->employeeGroup['risk_and_profit_percent'];
            $emp_group->risk_and_profit_value = $request->employeeGroup['risk_and_profit_value'];
            $emp_group->total_end_wage_normale_workhours_06_to_21 = $request->employeeGroup['total_end_wage_normale_workhours_06_to_21'];
            $emp_group->total_endwage_weekend_incl_50_toeslag = $request->employeeGroup['total_endwage_weekend_incl_50_toeslag'];
            $emp_group->total_endwage_holidays_incl_150_toeslag = $request->employeeGroup['total_endwage_holidays_incl_150_toeslag'];
            $emp_group->marge_loonkosten_eindtarief = $request->employeeGroup['marge_loonkosten_eindtarief'];
            $emp_group->save();
            $status = true;
        }
        return response()->json([
          'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeGroup  $employeeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeGroup $employeeGroup)
    {
        //
    }

    public function empGroupDetail($id)
    {
        $employeeGroup = EmployeeGroup::find($id);
        return response()->json([
            'employeeGroup' => $employeeGroup,
        ]);
    }

    public function emplInsuranceDetail()
    {
        $currentYear = date('Y');
        $daysDetail = WorkableDaysCalculation::where('year','=',$currentYear)
                                ->first();

        $insuranceDetail = SocialInsurance::where('year','=',$currentYear)
                                ->first();

        return response()->json([
            'daysDetail' => $daysDetail,
            'insuranceDetail' => $insuranceDetail,
        ]);
    }
}
