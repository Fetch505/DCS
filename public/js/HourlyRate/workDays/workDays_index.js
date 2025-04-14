Vue.use(VueSwal);

new Vue({
  'el' : '#app',
  created (){
    // console.log('hello Workable days');
  }, //created ends here

  data:{
    selectedLanguage : 'en',
    workableDays:{
      number_of_calendar_days: 365,
      weekend_days: '',
      work_days_a_year: 0,
      nat_holydays_short_absence_bijz_CAO_value: 0,
      holidays_value: 0,
      sickdays_value: 0,
      frost_days_off: 0,
      workable_days_a_year: 0,
      nat_holydays_short_absence_bijz_CAO_percent: 0,
      holidays_percent: 0,
      sickdays_percent: 0,
      rage_unworkable_days_in_percent: 0,
    },

  }, //data ends here
  mounted(){
    this.selectedLanguage = this.$refs.language.value;
  },

  methods:{
    addValues(){
      // console.log('hello');
      axios.post(APP_URL + `workableDaysCalculation`,{
        'message' : 'hello',
        'workableDays' : this.workableDays,
      })
      .then(response => {
        if(response.data.status){
          this.$swal({
            title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
            text: (this.selectedLanguage == 'en')?"Added workable days successfully":"Werkbare dagen met succes toegevoegd",
            icon: "success",
          })
          let indexUrl = this.$refs.url.value;
          setTimeout(function(){
            window.location = indexUrl;
           }, 3000);
        }else {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"This year data already exists, edit it":"Dit jaar bestaan ​​er al gegevens, bewerk deze", "error");
        }
      })
      .catch(error => {
        this.$swal("Ooops!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
      })
    },//add ends here
  }, //methods ends here

  computed:{
    work_days_a_year_comp: function () {
      let diff = parseInt(this.workableDays.number_of_calendar_days) - parseInt(this.workableDays.weekend_days);

      this.workableDays.work_days_a_year = diff;
      return diff;
    }, //total_prize ends here

    workable_days_a_year_comp: function () {
      let diff = parseFloat(this.workableDays.work_days_a_year) -parseFloat(this.workableDays.nat_holydays_short_absence_bijz_CAO_value) - parseFloat(this.workableDays.holidays_value) - parseFloat(this.workableDays.sickdays_value);

      diff = diff.toFixed('2');
      this.workableDays.workable_days_a_year = diff;
      return diff;
    }, //total_prize ends here

    nat_holydays_short_absence_bijz_CAO_comp: function () {
      let percent = ((parseFloat(this.workableDays.nat_holydays_short_absence_bijz_CAO_value) / parseFloat(this.workableDays.workable_days_a_year))*100).toFixed('2');

      this.workableDays.nat_holydays_short_absence_bijz_CAO_percent = percent;

      return percent;
    }, //total_prize ends here

    holidays_comp: function () {
      let percent = ((parseFloat(this.workableDays.holidays_value) / parseFloat(this.workableDays.workable_days_a_year))*100).toFixed('2');

      this.workableDays.holidays_percent = percent;
      return percent;
    }, //total_prize ends here

    sickdays_comp: function () {
      let percent = ((parseFloat(this.workableDays.sickdays_value) / parseFloat(this.workableDays.workable_days_a_year))*100).toFixed('2');

      this.workableDays.sickdays_percent = percent;
      return percent;
    }, //total_prize ends here

    rage_unworkable_days_in_comp: function () {
      let total = (parseFloat(this.workableDays.nat_holydays_short_absence_bijz_CAO_percent) + parseFloat(this.workableDays.holidays_percent) +  parseFloat(this.workableDays.sickdays_percent)).toFixed('2');

      this.workableDays.rage_unworkable_days_in_percent = total;
      return total;
    }, //total_prize ends here
  }, //computed ends here
})
