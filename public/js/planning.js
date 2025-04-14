Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    'el':'#app',
    data:{
        selectedWorkers: [],
        selectedProject: null,
        projects: [],
        randItems:['item1','item2','item3'],
        areas: [],
        elements: [],
        tasks: [],
        lastPushedTask: null,
        floors: [],
        types: [],
        total_weeks: [],
        language,
        errors:[],
        addJob: {
          id: null,
          project: null,
          floor: null,
          area: null,
          element: null,
          task: null,
          type: null,
          mon: null,
          tue: null,
          wed: null,
          thu: null,
          fri: null,
          sat: null,
          sun: null,
          selected_weeks: [],
          workingDay: 'mon'
        },
    },
    computed:{
        filterProjects(){
        }
    },
    methods:{
        toggleWorkerSelection(event) {
            const checkbox = event.target;
            const workerData = JSON.parse(checkbox.getAttribute('data-worker'));
            if (checkbox.checked) {
                this.selectedWorkers.push(workerData);
            } else {
                const index = this.selectedWorkers.findIndex(worker => 
                    worker.worker_id === workerData.worker_id && worker.day_id === workerData.day_id
                );
                if (index !== -1) {
                    this.selectedWorkers.splice(index, 1);
                }
            }
        },
        handleUnassign(){
            console.log("selectedWorkers: ", this.selectedWorkers);

            axios.post(APP_URL+`unassignWorkers`,{
                'selectedWorkers' : this.selectedWorkers,
            }).then(response => {
                console.log('Unassign Workers:', response.data);
                this.$swal("Good job!", (this.language == 'en')?"Workers Unassigned successfuly":"Workers succesvol Unassigned", "success");
                this.selectedWorkers = [];
                this.errors = '';
                if(response.data.status == 1){
                    const projectForm = document.getElementById('projectForm');
                    setTimeout(function(){
                        projectForm.submit();
                    }, 1000);
                }
            })
            .catch(error => {
                this.errors = error.response.data.errors;
                console.log(error);
                this.$swal("Ooops!", (this.language == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
            });
        },
        elementChanged() {
            console.log('Selected Element:', this.addJob.element.id);
            axios.get(APP_URL + `getRelatedTasks/${this.addJob.element.id}`)
            .then(response => {
                this.tasks = response.data.data.tasks.filter(task => task.name !== null);
                if (this.lastPushedTask && !this.tasks.includes(this.lastPushedTask)) {
                    this.tasks.push(this.lastPushedTask);
                }      
            }).catch(error => {
              console.log(error);
            })
        },
        closeAddModel() {
            this.addJob.id = null;
            this.addJob.project = null;
            this.addJob.floor = null;
            this.addJob.area = null;
            this.addJob.element = null;
            this.addJob.task = null;
            if (this.language === 'en') {
              this.addJob.type = 'Daily';
            } else {
              this.addJob.type = 'Dagelijks';
            }
            this.addJob.mon = null;
            this.addJob.tue = null;
            this.addJob.wed = null;
            this.addJob.thu = null;
            this.addJob.fri = null;
            this.addJob.sat = null;
            this.addJob.sun = null;
            this.addJob.selected_weeks = [];
            this.addJob.workingDay = 'mon';
        },
        assignJob(){
            console.log("ADD_JOB:", this.addJob);
            if(!this.addJob.project || !this.addJob.floor || !this.addJob.area ||!this.addJob.element || !this.addJob.task){
                this.$swal("Sorry!", (this.language == 'en')?"Please select all for new job":"Selecteer alles, voor nieuwe taak", "error");
            } else if (this.addJob.type === 'Daily' && !(this.addJob.mon || this.addJob.tue || this.addJob.wed || this.addJob.thu || this.addJob.fri || this.addJob.sat || this.addJob.sun) ) {
                this.$swal("Sorry!", (this.language == 'en')?"Please select work day for new job!":"Selecteer dagen, voor nieuwe taak", "error");
            } else if(this.addJob.type ==='Weekly'&& this.addJob.selected_weeks.length === 0 ) {
                this.$swal("Sorry!", (this.language == 'en')?"Please select work day for new job!":"Selecteer dagen, voor nieuwe taak", "error");
            } else {
                let newJob = {
                    project_id: this.addJob.project.id,
                    floor_id: this.addJob.floor.id,
                    area_id: this.addJob.area.id,
                    element_id: this.addJob.element.id,
                    task_id: this.addJob.task.id,
                    type: this.addJob.type,
                    mon: this.addJob.mon,
                    tue: this.addJob.tue,
                    wed: this.addJob.wed,
                    thu: this.addJob.thu,
                    fri: this.addJob.fri,
                    sat: this.addJob.sat,
                    sun: this.addJob.sun,
                    workingDay: this.addJob.workingDay,
                    week_number: this.addJob.selected_weeks
                };
                console.log("NEW_JOB:", newJob);
                axios.post(APP_URL+`assignWorkers`,{
                    'selectedWorkers' : this.selectedWorkers,
                    'newJob' : newJob,
                }).then(response => {
                    console.log('response ',response.data);
                    this.$swal("Good job!", (this.language == 'en')?"Workers Assigned successfuly":"Workers succesvol Assigned", "success");
                    this.closeAddModel();
                    this.errors = '';
                    if(response.data.status == 1){
                        const projectForm = document.getElementById('projectForm');
                        setTimeout(function(){
                            projectForm.submit();
                        }, 1000);
                    }
                })
                .catch(error => {
                    this.$swal("Sorry!", (this.language == 'en')?"An error occurred. Please try again later.":"An error occurred. Please try again later.", "error");
                    this.errors = error.response.data.errors;
                    console.log(error);
                })
            }
        }
    },
    created() {
        this.selectedProject = parseInt(selectedProjectId);
        this.projects= initialData.projects;
        this.areas= initialData.areas;
        this.elements= initialData.elements;
        this.floors= initialData.floors;
        if(this.language === 'en') {
          this.types = {'daily' : 'Daily','weekly' : 'Weekly','one-time' : 'One-Time','extra' : 'Extra'};
        } else {
          this.types = {'daily' : 'Dagelijks','weekly' : 'Wekelijks','one-time' : 'Eenmalig','extra' : 'Extra'};
        }
        
        let i = 1;
        for (i = 1; i <= 52; i++) {
        this.total_weeks.push(i)
        }

    },
    mounted(){
        if (this.language === 'en') {
          this.addJob.type = 'Daily';
        } else {
          this.addJob.type = 'Dagelijks';
        }
        console.log("Projects:", this.projects);
        console.log("projects_id:",this.selectedProject);
        this.projects = this.projects.filter(project => project.id !== this.selectedProject);
        console.log("Selected Projects:", this.projects);
    },
});