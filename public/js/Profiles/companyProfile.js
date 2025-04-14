new Vue({
  'el' : '#app',
  data:{
    company:'',
    name:'',
    email:'',
    address:'',
    country:'',
    language:'',
    phone:'',
    pass:'',
    passwordField:'password',
    eyeIcon:'fa fa-eye',
    emailError:false,
  },
  methods:{
    chageVisibility(){
      if (this.passwordField === 'password') {
        this.passwordField = 'text';
        this.eyeIcon = 'fa fa-eye-slash';
      }else {
        this.passwordField = 'password';
        this.eyeIcon = 'fa fa-eye';
      }
    }, // chageVisibility ends here
    checkEmail(email){
      var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;

      return re.test(email);
    }, //checkEmail ends here

    updateDetails(){
      //console.log(this.language);
      //return;
      if (this.checkEmail(this.email)) {
        this.emailError = false;
        axios.post(APP_URL + `companyUpdateDetail`,{
          'email' : this.email,
          'password' : this.pass,
          'language' : this.language,
        })
        .then(response => {
          this.$swal("Good job!", "Company information updated successfuly!, (Bedrijfsinformatie succesvol bijgewerkt)", "success");
        })
        .catch(error => {
          console.log(error);
        });
      }else {
        this.emailError = true;
      }
    }, //updateDetails end here
  },
  mounted(){
    axios.get(APP_URL + `/companyDetail`)
    .then(response => {
      console.log('IS ka batao:',response.data.company_data.name)
      //this.company = response.data.company.name;
      this.name = response.data.company_data.name;
      this.email = response.data.company_data.email;
      this.language = response.data.company_data.language;
    })
    .catch(error => {
      console.log(error);
    });
  },
})
