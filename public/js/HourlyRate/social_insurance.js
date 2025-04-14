
new Vue({
  'el' : '#app',
  created (){
    // console.log('hello social Insurance sasdas');
  }, //created ends here

  data:{
    selectedLanguage : 'en',
    socialInsurance:{
      WAO_basic_prize: 0,
      WAO_calculateprize: 0,
      WGA_calculateprize: 0,
      total_prize_PEMBA_IVA: 0,
      Unemploymentlaw_ww1: 0,
      Redundancy_fund_incl_childcare: 0,
      Healtcarelaw: 0,
      Pre_pension: 0,
      AOP_p: 0,
      OP_NP_pension_2: 0,
      Pension_transitional_arrangement: 0,
      VUT_transitional_arrangement: 0,
      Final_levy_VUT_transitional_arrangement: 0,
      O_R_zie_RAS_heffing: 0,
      Childcare_zie_resdundancy_fund: 0,
      RAS_charge: 0,
      Totaal_prize_divers: 0,
      Totaal_sociale_insurances: 0,
    },
  }, //data ends here

  mounted(){
    this.selectedLanguage = this.$refs.language.value;
  },

  methods:{
    addValues(){
      // console.log('hello');
      axios.post(APP_URL + `socialInsurance`,{
        'message' : 'hello',
        'social_insurance' : this.socialInsurance,
      })
      .then(response => {
        if(response.data.status){
          this.$swal({
            title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
            text: (this.selectedLanguage == 'en')?"Social insurance successfully added":"Sociale verzekering succesvol toegevoegd",
            icon: "success",
          })
        }else{
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"This year data already exists, edit it":"Dit jaar bestaan ​​er al gegevens, bewerk deze", "error");
        }

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
