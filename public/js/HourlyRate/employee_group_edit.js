
new Vue({
  'el' : '#app',
  created (){
    console.log('hello social Insurance sasdas');
  }, //created ends here

  data:{
    id:'',
    selectedLanguage : 'en',
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
    saveValues(){
      axios.put(APP_URL + `employeeGroup/${this.id}`,{
        'message' : 'hello',
        'employeeGroup' : this.employeeGroup,
        'id' : this.id,
      })
      .then(response => {
        console.log('response data : ', response.data);
        if (response.data.status) {
          this.$swal({
            title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
            text: (this.selectedLanguage == 'en')?"Updated group details successfully":"Groeps gegevens succesvol bijgewerkt",
            icon: "success",
          });
          let indexUrl = this.$refs.url.value;
          setTimeout(function(){
            window.location = indexUrl;
          }, 2000);
        }else {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"The same name group already exists, edit it":"Dezelfde naamgroep bestaat al, bewerk deze", "error");
        }
      })
      .catch(error => {
        this.$swal("Ooops!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
        console.log('error :',error)
      })
    },//add ends here
  }, //methods ends here

  mounted(){
    this.selectedLanguage = this.$refs.language.value;
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

        /// to update value with social insurance and other CRUDs////
        axios.get(APP_URL + `emplInsuranceDetail`)
        .then(response=>{
          this.employeeGroup.social_insurance_premiums_percent = response.data.insuranceDetail['Totaal_sociale_insurances'];

          this.employeeGroup.nationale_holidays_percent = response.data.daysDetail['nat_holydays_short_absence_bijz_CAO_percent'];

          this.employeeGroup.holidays_percent = response.data.daysDetail['holidays_percent'];

          this.employeeGroup.costs_absenteeism_percent = response.data.daysDetail['sickdays_percent'];
          console.log('created ', response.data);
        })
        .catch(error => {
          console.log(error);
        });
        /// to update value with social insurance and other CRUDs////
    })
    .catch(error => {
      console.log(error);
    });
  },//created ends here


    computed:{

      holiday_allowence_comp: function () {

        let percent = this.employeeGroup.holiday_allowence_percent;

        let gross_val = this.employeeGroup.gross_hour_wage;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.holiday_allowence_value = result;
        return result;
      }, //

      gross_hour_wage_comp: function () {
        let val = this.employeeGroup.basic_hour_rate;

        this.employeeGroup.gross_hour_wage = val;
        return val;
      }, //

      end_year_allowence_comp: function () {
        let percent = this.employeeGroup.end_year_allowence_percent;

        let gross_val = this.employeeGroup.gross_hour_wage;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.end_year_allowence_value = result;
        return result;
      }, //

      gross_wage_including_allowaence_comp: function () {

        let end_yr_allw = parseFloat(this.employeeGroup.end_year_allowence_value);

        let holliday_allw = parseFloat(this.employeeGroup.holiday_allowence_value);

        let gross_val = parseFloat(this.employeeGroup.gross_hour_wage);

        let y = (end_yr_allw + holliday_allw + gross_val );

        let result = Number(y).toFixed(2);

        // console.log('sum : ', y);
        // console.log('resut : ', result);
        // console.log('end_yr_allw : ', end_yr_allw);
        // console.log('holliday_allw : ', holliday_allw);
        // console.log('gross_val : ', gross_val);

        this.employeeGroup.gross_wage_including_allowaence = result;
        return result;
      }, //

      social_insurance_premiums_comp: function () {
        let percent = this.employeeGroup.social_insurance_premiums_percent;

        let gross_val = this.employeeGroup.gross_wage_including_allowaence;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        let gross_wage = parseFloat(result) + parseFloat(gross_val);

        this.employeeGroup.social_insurance_premiums_value = result;

        this.employeeGroup.subtotal_wage_costs_per_hour_1 = gross_wage;
        return result;
      }, //

      nationale_holidays_comp: function () {
        let percent = this.employeeGroup.nationale_holidays_percent;

        let gross_val = this.employeeGroup.subtotal_wage_costs_per_hour_1;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.nationale_holidays_value = result;
        return result;
      }, //

      holidays_comp: function () {
        let percent = this.employeeGroup.holidays_percent;

        let gross_val = this.employeeGroup.subtotal_wage_costs_per_hour_1;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.holidays_value = result;
        return result;
      }, //

      costs_absenteeism_comp: function () {
        let percent = this.employeeGroup.costs_absenteeism_percent;

        let gross_val = this.employeeGroup.subtotal_wage_costs_per_hour_1;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.costs_absenteeism_value = result;

        let gross_wage = parseFloat(gross_val) + parseFloat(this.employeeGroup.costs_absenteeism_value) + parseFloat(this.employeeGroup.holidays_value) + parseFloat(this.employeeGroup.nationale_holidays_value);

        this.employeeGroup.subtotal_wage_costs_per_hour = gross_wage;

        this.employeeGroup.total_wage_costs_per_hour = gross_wage;

        return result;
      }, //

      material_en_recorses_machines_comp: function () {
        let percent = this.employeeGroup.material_en_recorses_machines_percent;

        let gross_val = this.employeeGroup.subtotal_wage_costs_per_hour;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.material_en_recorses_machines_value = result;
        return result;
      }, //

      workclothing_en_equipment_comp: function () {
        let percent = this.employeeGroup.workclothing_en_equipment_percent;

        let gross_val = this.employeeGroup.subtotal_wage_costs_per_hour;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.workclothing_en_equipment_value = result;
        return result;
      }, //

      total_direct_costs_comp: function () {
        let percent = this.employeeGroup.workclothing_en_equipment_percent;

        let gross_val = this.employeeGroup.total_wage_costs_per_hour;

        let y = parseFloat(gross_val) + parseFloat(this.employeeGroup.workclothing_en_equipment_value) + parseFloat(this.employeeGroup.material_en_recorses_machines_value);

        let result = Number(y).toFixed(2);

        this.employeeGroup.total_direct_costs = result;
        return result;
      }, //

      indirectly_supervision_managementcosts_comp: function () {
        let percent = this.employeeGroup.indirectly_supervision_managementcosts_percent;

        let gross_val = this.employeeGroup.total_direct_costs;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.indirectly_supervision_managementcosts_value = result;
        return result;
      }, //

      education_training_comp: function () {
        let percent = this.employeeGroup.education_training_percent;

        let gross_val = this.employeeGroup.total_direct_costs;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.education_training_value = result;
        return result;
      }, //

    companycosts_administration_housing_costs_comp: function () {
        let percent = this.employeeGroup.companycosts_administration_housing_costs_percent;

        let gross_val = this.employeeGroup.total_direct_costs;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.companycosts_administration_housing_costs_value = result;
        return result;
      }, //

    reis_auto_kosten_overige_comp: function ()
      {
        let percent = this.employeeGroup.reis_auto_kosten_overige_percent;

        let gross_val = this.employeeGroup.total_direct_costs;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.reis_auto_kosten_overige_value = result;
        return result;
      }, //

    total_indirecte_costs_comp: function ()
      {
        let gross_val = this.employeeGroup.total_direct_costs;

        let y = parseFloat(gross_val) + parseFloat(this.employeeGroup.indirectly_supervision_managementcosts_value) + parseFloat(this.employeeGroup.education_training_value) + parseFloat(this.employeeGroup.companycosts_administration_housing_costs_value) + parseFloat(this.employeeGroup.reis_auto_kosten_overige_value);

        let result = Number(y).toFixed(2);

        this.employeeGroup.total_indirecte_costs = result;
        return result;
      }, //

    risk_and_profit_comp: function ()
      {
        let percent = this.employeeGroup.risk_and_profit_percent;

        let gross_val = this.employeeGroup.total_indirecte_costs;

        let y = (percent * gross_val)/100;

        let result = Number(y).toFixed(2);

        this.employeeGroup.risk_and_profit_value = result;
        return result;
      }, //

    total_end_wage_normale_workhours_06_to_21_comp: function ()
      {
        let y = parseFloat(this.employeeGroup.risk_and_profit_value) + parseFloat(this.employeeGroup.total_indirecte_costs);

        let result = Number(y).toFixed(2);

        this.employeeGroup.total_end_wage_normale_workhours_06_to_21 = result;
        return result;
      }, //

    marge_loonkosten_eindtarief_comp: function ()
      {
        let y = parseFloat(this.employeeGroup.total_end_wage_normale_workhours_06_to_21) - parseFloat(this.employeeGroup.total_wage_costs_per_hour);

        let result = Number(y).toFixed(2);

        this.employeeGroup.marge_loonkosten_eindtarief = result;
        return result;
      }, //

    total_endwage_weekend_incl_50_toeslag_comp: function ()
      {
        let y = parseFloat(this.employeeGroup.marge_loonkosten_eindtarief) + (parseFloat(this.employeeGroup.total_wage_costs_per_hour * 1.5));

        let result = Number(y).toFixed(2);

        this.employeeGroup.total_endwage_weekend_incl_50_toeslag = result;
        return result;
      }, //

    total_endwage_holidays_incl_150_toeslag_comp: function ()
      {
        let y = parseFloat(this.employeeGroup.marge_loonkosten_eindtarief) + (parseFloat(this.employeeGroup.total_wage_costs_per_hour * 2.5));

        let result = Number(y).toFixed(2);

        this.employeeGroup.total_endwage_holidays_incl_150_toeslag = result;
        return result;
      }, //
    }, //computed ends here

})
