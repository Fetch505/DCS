new Vue({
  el:'#app',
  data:{
    customer:'',
    project:'',
    project_name:'',
    project_address:'',
    inspector:'',
    tasks:[],
    projects:[],
    url: APP_URL+'downloadPdfReport/',
  },//data ends here

  created(){
    axios.get(APP_URL + `companyProjects`)
    .then(response => {
      this.projects = response.data.projects;
      console.log('response : ',response);
    })
    .catch(error => {
      console.log('error',error);
    })
  },//created ends here
  methods:{
    projectChanged(){
      console.log('projectChanged',this.project);
      // this.url = this.url + this.project
      axios.post(APP_URL+`projectInspectionReport`,{
        'project_id' : this.project
      })
      .then(response=>{
        console.log('response',response.data);
        this.tasks = response.data.tasks;
        this.project_name = response.data.project_name;
        this.project_address = response.data.project_address;
        this.inspector = response.data.inspector;
      })
      .catch(error=>{
        console.log('error',error);
      })
    },//customerChanged ends here
  },//methods ends here
})
