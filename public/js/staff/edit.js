new Vue({
  el:'#app',
  data:{
    userID: null,
    errors: [],
    language,
  },
  mounted(){
    this.userID = parseInt(userId);
    console.log("hello I am mounted in edit vue js", this.userID)

  },

  methods:{
    confirmStatusChange() {
      console.log("hello I am here in edit vue js")
      var selectedValue = document.querySelector('select[name="status"]').value;
      if (selectedValue === '0') {
        var confirmation = confirm("This will unassign the user from all projects. Are you sure?");
        if (!confirmation) {
          // If the user cancels, reset the select element to its previous value (1 for Active).
          document.querySelector('select[name="status"]').value = '1';
        }
        else{
          axios.get(APP_URL+`inactiveUser/${this.userID}`).then(response => {
              console.log('Unassign Workers:', response.data);
              this.$swal("Good job!", (this.language == 'en')?"User Inactive successfuly":"User succesvol Inactief", "success");
              this.errors = '';
          })
          .catch(error => {
              this.errors = error.response.data.errors;
              console.log(error);
              this.$swal("Ooops!", (this.language == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
          });
        }
      }
    }
  },
})
