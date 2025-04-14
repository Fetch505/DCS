
Vue.use(VueSwal);

new Vue({
  'el' : '#app',
  data:{
    selectedLanguage : 'en',
    employeeGroup:{
      group_name: '',
      basic_hour_rate: 0,
      end_year_allowence_percent: 0,
      end_year_allowence_value: 0,
      holiday_allowence_percent: 0,
      holiday_allowence_value: 0,
      gross_hour_wage: 0,
      gross_wage_including_allowaence: 0,
      social_insurance_premiums_percent: 0,
      social_insurance_premiums_value: 0,
      subtotal_wage_costs_per_hour_1:0,
      nationale_holidays_percent: 0,
      nationale_holidays_value: 0,
      holidays_percent: 0,
      holidays_value: 0,
      costs_absenteeism_percent:0,
      costs_absenteeism_value:0,
      subtotal_wage_costs_per_hour: 0,
      total_wage_costs_per_hour: 0,
      material_en_recorses_machines_percent: 0,
      material_en_recorses_machines_value: 0,
      workclothing_en_equipment_percent: 0,
      workclothing_en_equipment_value: 0,
      total_direct_costs: 0,
      indirectly_supervision_managementcosts_percent: 0,
      indirectly_supervision_managementcosts_value: 0,
      education_training_percent: 0,
      education_training_value: 0,
      companycosts_administration_housing_costs_percent: 0,
      companycosts_administration_housing_costs_value: 0,
      reis_auto_kosten_overige_percent: 0,
      reis_auto_kosten_overige_value: 0,
      total_indirecte_costs: 0,
      risk_and_profit_percent: 0,
      risk_and_profit_value: 0,
      total_end_wage_normale_workhours_06_to_21: 0,
      total_endwage_weekend_incl_50_toeslag: 0,
      total_endwage_holidays_incl_150_toeslag: 0,
      marge_loonkosten_eindtarief: 0,
    },

  }, //data ends here
  mounted(){
    this.selectedLanguage = this.$refs.language.value;
  },

  created(){
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
  }, //created ends here

  methods:{

    addGroup(){
      let indexUrl = this.$refs.url.value;

      axios.post(APP_URL + `employeeGroup`,{
        'employeeGroup' : this.employeeGroup,
      })
      .then(response => {
        if (response.data.status) {
          this.$swal({
            title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
            text: (this.selectedLanguage == 'en')?"New group added successfully":"Nieuwe groep succesvol toegevoegd",
            icon: "success",
          })
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
        console.log(error)
      })

    },//add ends here
  }, //methods ends here

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
