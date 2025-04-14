new Vue({
  el:'#app',
  created(){
    this.getAllJobs();
  },
  data:{
    dailyJobs:[],
    weeklyJobs:[],
    weekCards:'',
    timeCards:'',
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
  },
  methods:{
    getAllJobs(){
      axios(APP_URL + `/workerAllJobs`).then(response => {
        this.dailyJobs = response.data.dailyJobs;
        this.weeklyJobs = response.data.weeklyJobs;
        console.log(this.dailyJobs);
      }).catch(error=>{
        console.log(error);
      })
    },//getAllJobs ends here

    showDetails(job){
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

      axios(APP_URL + `/getWeekCards/${job['id']}`)
      .then(response=>{
        console.log('response week cards', response.data.week_cards);
        this.weekCards = response.data.week_cards;
        this.timeCards = response.data.time_cards;
        console.log('this week cards', this.weekCards);
        console.log('this time cards', this.timeCards);
        console.log('first value', this.weekCards[0].weeknumber);

      }).catch(error=>{
        console.log(error);
      })
    },//showDetails ends here

    closeModal(){
      console.log('modal close');
      this.weekCards='';
    }, //closeModal ends here

  },
})
