Vue.component('v-select', VueSelect.VueSelect);
new Vue({
  el: '#app',
  created(){
    console.log('vue set');
  }, //created ends here

  mounted(){
    console.log('project Id = ', this.$refs.proj_id.value);
    this.project_id = this.$refs.proj_id.value;
  }, //mounted ends here

  data: {
    flag:true,
    floor_id:'',
    area_id:'',
    area:'',
    job_id:'',
    project_id:'',
    route:'',
    downloadButton:false,
    showAllJobs:false,
    days:[],
    areas:[],
    message:"Hello world",
  },// data ends here

  methods:{

    search(){
      this.downloadButton = false;
      this.days = '';
      this.job_id = '';
      this.area_id = this.area.id;
      console.log('area_id ', this.area_id);
      axios.post(APP_URL + `getFloorAreaJobs`,{
        'project_id' : this.project_id,
        'floor_id'   : this.floor_id,
        'area_id'   : this.area_id,
      })
      .then(response => {
        console.log('Floor Area days', response);
        this.days = response.data.data;
        this.job_id = response.data.job_id;
        this.route = APP_URL+"projectJobPdf/"+this.project_id+"/"+this.job_id+"/"+this.area_id+" ";
        console.log('job_d = ', this.job_id);
        console.log(this.days);
        if(this.days.length > 0){
          this.downloadButton = true;
        }

      })
      .catch(error => {
        console.log(error);
      })
    },//search ends here

    floorChanged(){
      this.areas = '';
      this.area_id = null;
      this.days = '';
      this.downloadButton = false;
      console.log('floor changed');
      axios.post(APP_URL + `getFloorAreas`,{
        'project_id':this.project_id,
        'floor_id':this.floor_id,
      })
      .then(response=>{
        console.log(response);
        this.areas = response.data.areas;
      })
      .catch(error=>{console.log(error)})
    },//florrChanged ends here


  },// methods ends here
})
