Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);
new Vue({
    'el':'#app',
    data:{
        title:'',
        description:'',
        time_starts:'',
        time_cushion:'',
        time_ends:'',
        total_time:'',
        selectedLanguage : 'en',
        errors:[],
    },
    methods:{
    saveDetails(){
      this.errors = [];

      // Perform file validation
      if (!this.title) {
        this.errors.title = 'Title is required.';
      }

      if (!this.time_starts) {
        this.errors.time_starts = 'Start Time is required.';
      }

      if (!this.time_ends) {
        this.errors.time_ends = 'End Time is required.';
      }

        if (!this.total_time) {
            this.errors.total_time = 'Total Time is required.';
        }

      if (!this.time_cushion) {
        this.time_cushion = 0;
      }
      console.log('time_cushion:', this.time_cushion);
      console.log('Start:', this.time_starts);
      console.log('end:', this.time_ends);

      axios.post(APP_URL+`shift`,{
        'title' : this.title,
        'description' : this.description,
        'time_starts' : this.time_starts,
        'time_ends' : this.time_ends,
        'total_time' : this.total_time,
        'time_cushion': this.time_cushion,
      })
      .then(response => {
        console.log('Save Details message:', response.data.message);
        this.$swal("Good job!", (this.selectedLanguage == 'en')?"Shift added successfully":"Shift succesvol toegevoegd", "success");
        this.title='';
        this.description='';
        this.time_starts='';
        this.time_ends='';
        this.total_time='';
        this.time_cushion='';
        if(response.data.status == 1){
          setTimeout(function(){
            window.location.href = APP_URL + `shift`;
          }, 2000);
        }
        this.errors = '';
      })
      .catch(error => {
        this.errors = error.response.data.errors;
        console.log(error);
        this.$swal("Ooops!", (this.selectedLanguage == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
      });

    },
    },
    mounted(){
        this.selectedLanguage = this.$refs.language.value;
      },
});
