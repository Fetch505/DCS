
new Vue({
  'el' : '#app',
  created (){
    // console.log('hello social Insurance view created');
  }, //created ends here

  data:{
    id:'',
    employeeGroup:{
      group_name: '',
      basic_hour_rate: '',
      end_year_allowence_percent: '',
      end_year_allowence_value: '',
      holiday_allowence_percent: '',
      holiday_allowence_value: '',
      gross_hour_wage: '',
      gross_wage_including_allowaence: '',
      social_insurance_premiums_percent: '',
      social_insurance_premiums_value: '',
      subtotal_wage_costs_per_hour_1:'',
      nationale_holidays_percent: '',
      nationale_holidays_value: '',
      holidays_percent: '',
      holidays_value: '',
      costs_absenteeism_percent:'',
      costs_absenteeism_value:'',
      subtotal_wage_costs_per_hour: '',
      total_wage_costs_per_hour: '',
      material_en_recorses_machines_percent: '',
      material_en_recorses_machines_value: '',
      workclothing_en_equipment_percent: '',
      workclothing_en_equipment_value: '',
      total_direct_costs: '',
      indirectly_supervision_managementcosts_percent: '',
      indirectly_supervision_managementcosts_value: '',
      education_training_percent: '',
      education_training_value: '',
      companycosts_administration_housing_costs_percent: '',
      companycosts_administration_housing_costs_value: '',
      reis_auto_kosten_overige_percent: '',
      reis_auto_kosten_overige_value: '',
      total_indirecte_costs: '',
      risk_and_profit_percent: '',
      risk_and_profit_value: '',
      total_end_wage_normale_workhours_06_to_21: '',
      total_endwage_weekend_incl_50_toeslag: '',
      total_endwage_holidays_incl_150_toeslag: '',
      marge_loonkosten_eindtarief: '',
    },

  }, //data ends here

  methods:{

  }, //methods ends here

  mounted(){
    this.id = this.$refs.id.value;
    console.log('Id = ', this.id);
    axios.get(APP_URL+`emplGroupDetail/${this.id}`)
    .then(response=>{
      console.log(response.data.employeeGroup);

      this.employeeGroup.group_name = response.data.employeeGroup.name;
      this.employeeGroup.basic_hour_rate = response.data.employeeGroup.basic_hour_rate;
      this.employeeGroup.end_year_allowence_percent = response.data.employeeGroup.end_year_allowence_percent;
      this.employeeGroup.end_year_allowence_value = response.data.employeeGroup.end_year_allowence_value;
      this.employeeGroup.holiday_allowence_percent = response.data.employeeGroup.holiday_allowence_percent;
      this.employeeGroup.holiday_allowence_value = response.data.employeeGroup.holiday_allowence_value;
      this.employeeGroup.gross_hour_wage = response.data.employeeGroup.gross_hour_wage;
      this.employeeGroup.gross_wage_including_allowaence = response.data.employeeGroup.gross_wage_including_allowaence;
      this.employeeGroup.social_insurance_premiums_percent = response.data.employeeGroup.social_insurance_premiums_percent;
      this.employeeGroup.social_insurance_premiums_value = response.data.employeeGroup.social_insurance_premiums_value;
      this.employeeGroup.nationale_holidays_percent = response.data.employeeGroup.nationale_holidays_percent;
      this.employeeGroup.nationale_holidays_value = response.data.employeeGroup.nationale_holidays_value;
      this.employeeGroup.holidays_percent = response.data.employeeGroup.holidays_percent;
      this.employeeGroup.holidays_value = response.data.employeeGroup.holidays_value;
      this.employeeGroup.costs_absenteeism_percent = response.data.employeeGroup.costs_absenteeism_percent;
      this.employeeGroup.costs_absenteeism_value = response.data.employeeGroup.costs_absenteeism_value;
      this.employeeGroup.subtotal_wage_costs_per_hour = response.data.employeeGroup.subtotal_wage_costs_per_hour;
      this.employeeGroup.total_wage_costs_per_hour = response.data.employeeGroup.total_wage_costs_per_hour;
      this.employeeGroup.material_en_recorses_machines_percent = response.data.employeeGroup.material_en_recorses_machines_percent;
      this.employeeGroup.material_en_recorses_machines_value = response.data.employeeGroup.material_en_recorses_machines_value;
      this.employeeGroup.workclothing_en_equipment_percent = response.data.employeeGroup.workclothing_en_equipment_percent;
      this.employeeGroup.workclothing_en_equipment_value = response.data.employeeGroup.workclothing_en_equipment_value;
      this.employeeGroup.total_direct_costs = response.data.employeeGroup.total_direct_costs;
      this.employeeGroup.indirectly_supervision_managementcosts_percent = response.data.employeeGroup.indirectly_supervision_managementcosts_percent;
      this.employeeGroup.indirectly_supervision_managementcosts_value = response.data.employeeGroup.indirectly_supervision_managementcosts_value;
      this.employeeGroup.education_training_percent = response.data.employeeGroup.education_training_percent;
      this.employeeGroup.education_training_value = response.data.employeeGroup.education_training_value;
      this.employeeGroup.companycosts_administration_housing_costs_percent = response.data.employeeGroup.companycosts_administration_housing_costs_percent;
      this.employeeGroup.companycosts_administration_housing_costs_value = response.data.employeeGroup.companycosts_administration_housing_costs_value;

      this.employeeGroup.reis_auto_kosten_overige_percent = response.data.employeeGroup.reis_auto_kosten_overige_percent;
      this.employeeGroup.reis_auto_kosten_overige_value = response.data.employeeGroup.reis_auto_kosten_overige_value;
      this.employeeGroup.total_indirecte_costs = response.data.employeeGroup.total_indirecte_costs;
      this.employeeGroup.risk_and_profit_percent = response.data.employeeGroup.risk_and_profit_percent;
      this.employeeGroup.risk_and_profit_value = response.data.employeeGroup.risk_and_profit_value;
      this.employeeGroup.total_end_wage_normale_workhours_06_to_21 = response.data.employeeGroup.total_end_wage_normale_workhours_06_to_21;
      this.employeeGroup.total_endwage_weekend_incl_50_toeslag = response.data.employeeGroup.total_endwage_weekend_incl_50_toeslag;
      this.employeeGroup.total_endwage_holidays_incl_150_toeslag = response.data.employeeGroup.total_endwage_holidays_incl_150_toeslag;
      this.employeeGroup.marge_loonkosten_eindtarief = response.data.employeeGroup.marge_loonkosten_eindtarief;

    })
    .catch(error => {
      console.log(error);
    });
  },//created ends here
})
