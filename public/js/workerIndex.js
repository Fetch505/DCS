Vue.use(VueSwal);
new Vue({
  el:'#app',
  created(){
      console.log('hello mounted');
      this.getWorkerDetail();
  },//created ends here
  data:{
    message:'hello',
    dailyJobs:[],
    weeklyJobs:[],
    currentJob:[],
    jobStatusRequest:false,
    jobDetail:{
      id:'',
      customer:'',
      project_name:'',
      project_address:'',
      address:'',
      floor_name:'',
      area_name:'',
      task_name:'',
      job_status:'',
      note:'',
      mon:'',
      tue:'',
      wed:'',
      thu:'',
      fri:'',
      sat:'',
      sun:'',
      jobFinish:'',
      jobStart:'',
      start_time:'',
      end_time:'',
      total_time:'',
    },
  },//data ends here
  methods:{
    getWorkerDetail(){
      axios.get(APP_URL + `/workerDetails`).then( response => {
        console.log('daily job:', response.data.dailyJobs);
        console.log('weekly job:', response.data.weeklyJobs);
        this.dailyJobs = response.data.dailyJobs;
        this.weeklyJobs = response.data.weeklyJobs;
      }).catch(error=>{
        console.log(error);
      })
    },//getWorkerDetail ends here

    showDetails(job){
      this.currentJob = job;
      this.jobStatusRequest = false;
      console.log('show details job:', job);
      this.jobDetail.id = job['id'];
      this.jobDetail.customer_name = job['customer_name'];
      this.jobDetail.project_name = job['project_name'];
      this.jobDetail.project_address = job['project_address'];
      this.jobDetail.address = job['address'];
      this.jobDetail.floor_name = job['floor_name'];
      this.jobDetail.area_name = job['area_name'];
      this.jobDetail.task_name = job['task_name'];
      this.jobDetail.note = job['note'];
      this.jobDetail.mon = job['mon'];
      this.jobDetail.tue = job['tue'];
      this.jobDetail.wed = job['wed'];
      this.jobDetail.thu = job['thu'];
      this.jobDetail.fri = job['fri'];
      this.jobDetail.sat = job['sat'];
      this.jobDetail.sun = job['sun'];

      axios.get(APP_URL + `checkJobStatus/${job['id']}`)
      .then(response=>{
        console.log('status value :', response.data.status);
        this.jobStatusRequest = true;
        this.jobDetail.job_status = response.data.status;
        this.jobDetail.start_time = response.data.start_time;
        this.jobDetail.end_time = response.data.end_time;
        this.jobDetail.total_time = response.data.total_time;

        if (this.jobDetail.job_status == 1) {
          this.jobDetail.startJob = true;
          this.jobDetail.finishJob = false;
        }else if (this.jobDetail.job_status == 2) {
          this.jobDetail.startJob = false;
          this.jobDetail.finishJob = true;
        }else {
          this.jobDetail.startJob = false;
          this.jobDetail.finishJob = false;
        }
        console.log('StartJob Status:', this.jobDetail.startJob);
        console.log('finishJob Status:', this.jobDetail.finishJob);
      })
      .catch(error=>{
        console.log(error);
      })
    },//showDetails ends here

    startJob(){
      console.log('start Job ', this.jobDetail);
      this.jobDetail.jobStart=false;
      this.jobDetail.jobFinish=true;
      axios.get(APP_URL + `/startJob/${this.jobDetail.id}`)
      .then(response=>{
        console.log(response.data);
        this.$swal('Job started');
        // alert('Job started');
      })
      .catch(error=>{console.log(error)})
    },//startJob ends here

    endJob(){
      console.log('end Job ', this.jobDetail);
      axios.get(APP_URL + `/endJob/${this.jobDetail.id}`)
      .then(response=>{
        console.log(response.data);
        this.jobDetail.jobStart=false;
        this.jobDetail.jobFinish=false;
        this.$swal('Job finished');
        // alert('Job finished');
      })
      .catch(error=>{console.log(error)})
    },//startJob ends here
  },//methods ends here
})
