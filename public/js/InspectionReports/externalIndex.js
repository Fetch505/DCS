new Vue({
  el:'#app',
  data:{
    customer:'',
    project:'',
    customers:[],
    projects:[],
  },//data ends here

  created(){
    axios.get(APP_URL + `externalreportdata`)
    .then(response => {
      this.customers = response.data.customers;
      console.log('response : ',response);
    })
    .catch(error => {
      console.log('error',error);
    })
  },//created ends here
  methods:{
    customerChanged(){
      axios.get(APP_URL+`getCustomerProjects/`+this.customer)
      .then(response=>{
        this.projects = response.data.projects;
        console.log('projects',this.projects);
      })
      .catch(error=>{
        console.log('error',error);
      })
    },//customerChanged ends here
  },//methods ends here
})
