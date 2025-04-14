
new Vue({
  'el' : '#app',
  created (){
    // console.log('hello social Insurance sasdas');
  }, //created ends here

  data:{
    selectedLanguage : 'en',
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

  mounted(){
    this.selectedLanguage = this.$refs.language.value;
  },

  methods:{
    saveValues(){
      axios.put(APP_URL + `socialInsurance/${this.id}`,{
        'message' : 'hello',
        'social_insurance' : this.socialInsurance,
        'id' : this.id,
      })
      .then(response => {
          this.$swal({
            title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
            text: (this.selectedLanguage == 'en')?"Social insurance updated successfully":"Sociale verzekering succesvol bijgewerkt",
            icon: "success",
          })

        let indexUrl = this.$refs.url.value;
        setTimeout(function(){
          window.location = indexUrl;
         }, 3000);
      })
      .catch(error => {
        this.$swal("Ooops!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
      })
    },//add ends here
  }, //methods ends here

  mounted(){
    this.id = this.$refs.id.value;
    this.selectedLanguage = this.$refs.language.value;
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

  computed:{
    total_prize: function () {
      let sum = parseFloat(this.socialInsurance.WAO_basic_prize) + parseFloat(this.socialInsurance.WAO_calculateprize) + parseFloat(this.socialInsurance.WGA_calculateprize);

      this.socialInsurance.total_prize_PEMBA_IVA = sum;
      return sum;
    }, //total_prize ends here

    total_prize_divers:function () {
      let sum = parseFloat(this.socialInsurance.Unemploymentlaw_ww1) + parseFloat(this.socialInsurance.Redundancy_fund_incl_childcare) + parseFloat(this.socialInsurance.Healtcarelaw) + parseFloat(this.socialInsurance.Pre_pension) + parseFloat(this.socialInsurance.AOP_p) + parseFloat(this.socialInsurance.OP_NP_pension_2) + parseFloat(this.socialInsurance.Pension_transitional_arrangement) + parseFloat(this.socialInsurance.VUT_transitional_arrangement) + parseFloat(this.socialInsurance.Final_levy_VUT_transitional_arrangement) + parseFloat(this.socialInsurance.O_R_zie_RAS_heffing) + parseFloat(this.socialInsurance.Childcare_zie_resdundancy_fund) + parseFloat(this.socialInsurance.RAS_charge);

      this.socialInsurance.Totaal_prize_divers = sum;
      this.socialInsurance.Totaal_sociale_insurances = sum + parseFloat(this.socialInsurance.total_prize_PEMBA_IVA);
      return sum;
    }, //total_prize_divers ends here
  }, //computed ends here
})
