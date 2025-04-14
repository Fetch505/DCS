// import Swal from 'sweetalert'
//
// const Swal = require('sweetalert2')

new Vue({
  'el' : '#app',
  created (){
    console.log('hello social Insurance view');
  }, //created ends here

  data:{
    id:'',
    socialInsurance:{
      WAO_basic_prize: '',
      WAO_calculateprize: '',
      WGA_calculateprize: '',
      total_prize_PEMBA_IVA: '',
      Unemploymentlaw_ww1: '',
      Redundancy_fund_incl_childcare: '',
      Healtcarelaw: '',
      Pre_pension: '',
      AOP_p: '',
      OP_NP_pension_2: '',
      Pension_transitional_arrangement: '',
      VUT_transitional_arrangement: '',
      Final_levy_VUT_transitional_arrangement: '',
      O_R_zie_RAS_heffing: '',
      Childcare_zie_resdundancy_fund: '',
      RAS_charge: '',
      Totaal_prize_divers: '',
      Totaal_sociale_insurances: '',
    },

  }, //data ends here

  methods:{

  }, //methods ends here

  mounted(){
    this.id = this.$refs.id.value;
    axios.get(APP_URL+`insuranceDetail/${this.id}`)
    .then(response=>{
      console.log(response.data.socialInsurance.WAO_basic_prize);

      this.socialInsurance.WAO_basic_prize = response.data.socialInsurance.WAO_basic_prize;

      this.socialInsurance.WAO_calculateprize = response.data.socialInsurance.WAO_calculateprize;

      this.socialInsurance.WGA_calculateprize = response.data.socialInsurance.WGA_calculateprize;

      this.socialInsurance.Unemploymentlaw_ww1 = response.data.socialInsurance.Unemploymentlawww_1;

      this.socialInsurance.Redundancy_fund_incl_childcare = response.data.socialInsurance.Redundancy_fund_incl_childcare;

      this.socialInsurance.Healtcarelaw = response.data.socialInsurance.Healtcarelaw;

      this.socialInsurance.Pre_pension = response.data.socialInsurance.Pre_pension;

      this.socialInsurance.AOP_p = response.data.socialInsurance.AOP_p;

      this.socialInsurance.OP_NP_pension_2 = response.data.socialInsurance.OP_NP_pension_2;

      this.socialInsurance.Pension_transitional_arrangement = response.data.socialInsurance.Pension_transitional_arrangement;

      this.socialInsurance.VUT_transitional_arrangement = response.data.socialInsurance.VUT_transitional_arrangement;

      this.socialInsurance.Final_levy_VUT_transitional_arrangement = response.data.socialInsurance.Final_levy_VUT_transitional_arrangement;

      this.socialInsurance.O_R_zie_RAS_heffing = response.data.socialInsurance.O_R_zie_RAS_heffing;

      this.socialInsurance.Childcare_zie_resdundancy_fund = response.data.socialInsurance.Childcare_zie_resdundancy_fund;

      this.socialInsurance.RAS_charge = response.data.socialInsurance.RAS_charge;

      this.socialInsurance.Totaal_prize_divers = response.data.socialInsurance.Totaal_prize_divers;

      this.socialInsurance.Totaal_sociale_insurances = response.data.socialInsurance.Totaal_sociale_insurances;

      this.socialInsurance.total_prize_PEMBA_IVA = response.data.socialInsurance.total_prize_PEMBA_IVA;


    })
    .catch(error => {
      console.log(error);
    });
  },//created ends here


})
