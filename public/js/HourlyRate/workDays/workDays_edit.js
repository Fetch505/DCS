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

  methods:{
    saveValues(){
      console.log('hello');
      axios.put(APP_URL + `workableDaysCalculation/${this.id}`,{
        'message' : 'hello',
        'workableDays' : this.workableDays,
      })
      .then(response => {
        this.$swal({
          title: (this.selectedLanguage == 'en')?"Good Job!":"Goed gedaan",
          text: (this.selectedLanguage == 'en')?"Updated workable days successfully":"Werkbare dagen succesvol bijgewerkt",
          icon: "success",
        })

        let indexUrl = this.$refs.url.value;
        setTimeout(function(){
          window.location = indexUrl;
         }, 3000);
      })
      .catch(error => {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"This year data already exists, edit it":"Dit jaar bestaan ​​er al gegevens, bewerk deze", "error");
      })
    },//add ends here
  }, //methods ends here


    mounted(){
      this.id = this.$refs.id.value;
      this.selectedLanguage = this.$refs.language.value;
      // console.log('Id = ', this.id);
      axios.get(APP_URL+`workableDaysDetail/${this.id}`)
      .then(response=>{
        // console.log(response.data.workableDays);

        this.workableDays.weekend_days = response.data.workableDays.weekend_days;

        this.workableDays.work_days_a_year = response.data.workableDays.work_days_a_year;

        this.workableDays.nat_holydays_short_absence_bijz_CAO_value = response.data.workableDays.nat_holydays_short_absence_bijz_CAO_value;

        this.workableDays.holidays_value = response.data.workableDays.holidays_value;

        this.workableDays.sickdays_value = response.data.workableDays.sickdays_value;

        this.workableDays.workable_days_a_year = response.data.workableDays.workable_days_a_year;

        this.workableDays.nat_holydays_short_absence_bijz_CAO_percent = response.data.workableDays.nat_holydays_short_absence_bijz_CAO_percent;

        this.workableDays.holidays_percent = response.data.workableDays.holidays_percent;

        this.workableDays.sickdays_percent = response.data.workableDays.sickdays_percent;

        this.workableDays.rage_unworkable_days_in_percent = response.data.workableDays.rage_unworkable_days_in_percent;

      })
      .catch(error => {
        console.log(error);
      });
    },//created ends here


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
