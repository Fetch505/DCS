Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);
new Vue({
    'el':'#app',
    data:{
        file:'',
        video_url:'',
        selectedLanguage : 'en',
        errors:[],
    },
    mounted(){
        this.selectedLanguage = this.$refs.language.value;
      },
});