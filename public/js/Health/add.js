Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);
new Vue({
    'el':'#app',
    data:{
        title:'',
        description:'',
        file:'',
        category_id:'',
        video_url:'',
        selectedLanguage : 'en',
        errors:[],
    },
    methods:{
    handleFileInputChange() {
      this.file = this.$refs.file.files[0];
    },
    isValidFile(file) {
      const allowedExtensions = ['mp4', 'avi', 'mov', 'wmv'];
      const fileExtension = file.name.split('.').pop().toLowerCase();
      return allowedExtensions.includes(fileExtension);
    },
    uploadVideo(){
      this.errors = [];
      complete = true;

      // Perform file validation
      if (!this.title) {
        this.errors.title = 'Title is required.';
        complete = false;
      }

      if (!this.category_id) {
        this.errors.category_id = 'Category is required.';
      }

      if (!this.description) {
        this.errors.description = 'Description is required.';
        complete = false;
      }

      if (!this.file) {
        this.errors.file = 'Please select a file.';
        complete = false;
      }
      
      if(complete == true){
        
        var formData = new FormData();
        formData.append('title', this.title);
        formData.append('category_id', this.category_id);
        formData.append('description', this.description);
        formData.append('file', this.file);

        axios.post(APP_URL + `health`,  formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }) 
        .then(response => {
          console.log('Save Details message:', response.data.message);
          this.$swal("Good job!", (this.selectedLanguage == 'en')?"Added successfuly":"Succesvol toegevoegd", "success");
          this.title='';
          this.category_id='';
          this.description='';
          this.file='';
          this.video_url='';
          // if(response.data.status == 1){
          //   setTimeout(function(){
          //     window.location.href = APP_URL + `health`;
          //   }, 2000);
          // }
          this.errors = '';
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          console.log(error);
          this.$swal("Ooops!", (this.selectedLanguage == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
        });
      }
    },
    },
    mounted(){
      this.selectedLanguage = this.$refs.language.value;
    },
});