Vue.component('v-select', VueSelect.VueSelect);
new Vue({
  el: '#quotes',
  created(){
    console.log('hello');
    this.getDetails();
  },//created ends here

  // components:{
  //   'v-select':VueSelect,
  // },

  data:{
    show: false,
    name: 'abid',
    project : '',
    project_id : '',
    projects : [],
    materialList: [],

  },

  methods:{
    getDetails(){
      console.log('mounted and getDetails called');
      axios.get(APP_URL + `projectList`).then(response=>{
        console.log(response);
        this.projects = response.data.projectList;
        console.log('this project list', this.projects);
      }).catch(error=>{
        console.log(error);
      })
    },//getDetails ends here

    projectChanged(){
      console.log('projcet changed Id= ', this.project.id);
      this.project_id = this.project.id;
      axios.get(APP_URL + `quoteList/${this.project_id}`).then(response=>{
        console.log('response ', response);
        this.materialList = response.data.proj_materials;
        this.show = true;
        console.log('qList ', this.materialList);
      }).catch(error=>{
        console.log(error);
      });
    },//projectChanged ends here

    newRequest(){
      console.log('New request for quotes');
    },//newRequest ends here

    makeQuote(){
      console.log('New request for quotes');
      window.location.href = APP_URL + `quoteRequest/${this.project_id}`;
    },//newRequest ends here
  },
})//vue ends here
