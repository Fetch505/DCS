new Vue({
    el:'#app',
    data:{
        language,
        report: {
            id:null,
            project: null,
            task: null,
            worker: null,
            shift: null,
            created_at: null,
            country: null,
            check_in_time: null,
            check_out_time: null,
        },
    },
    methods:{
        postreport(selectedReport) {
            this.report.id = selectedReport.time_card_id;
            this.report.project = selectedReport.project_name;
            this.report.task = selectedReport.tasks_name;
            this.report.worker = selectedReport.worker_name;
            this.report.shift = selectedReport.shift_title;
            this.report.created_at = selectedReport.created_at.split(' ')[0];
            this.report.country = selectedReport.country;
            this.report.check_in_time = selectedReport.check_in_time;
            this.report.check_out_time = selectedReport.check_out_time;
            console.log("report", this.report);
        },
        saveReportChanges() {
            axios.put(APP_URL+`updateReport/${this.report.id}`,{
                'created_at' : this.report.created_at,
                'country' : this.report.country,
                'check_in_time' : this.report.check_in_time,
                'check_out_time' : this.report.check_out_time,
            }).then(response => {
                console.log('response ',response.data);
                this.$swal("Good job!", (this.language == 'en')?"Time updated successfully":"Tijd succesvol geüpdatet", "success");
                
                if(response.data.status == 1){
                    const reportForm = document.getElementById('reportForm');
                    this.report.id = null;
                    this.report.project = null;
                    this.report.task = null;
                    this.report.worker = null;
                    this.report.shift = null;
                    this.report.created_at = null;
                    this.report.country = null;
                    this.report.check_in_time = null;
                    this.report.check_out_time = null;
                    setTimeout(function(){
                        reportForm.submit();
                    }, 1000);
                }
            })
            .catch(error => {
                this.$swal("Sorry!", (this.language == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
    },

    mounted(){
        console.log('language ',this.language);
    },
})
