Vue.component('v-select', VueSelect.VueSelect);
new Vue({
  el: '#edit_project',
  created(){

    let i = 1;
    for (i = 1; i <= 52; i++) {
      this.total_weeks.push(i)
    }

  }, // createed function ends here
  mounted(){
    //console.log(this.elements);
    this.getProjectDetail();
    this.selectedLanguage = this.$refs.language.value;
    var self = this;

    $('#startDate').datepicker({
      dateFormat: 'dd MM yy',
      //minDate: 0, // disable dates before today
      onSelect:function(selectedDate, datePicker) {
          self.project.start_date = selectedDate;

          if (self.project.end_date) {
            var endDate = new Date(self.project.end_date).toISOString().slice(0,10);
            var startDate = new Date(selectedDate).toISOString().slice(0,10);
            var d1 = new Date(startDate);
            var d2 = new Date(endDate);
            if(d1 > d2){
              self.project.start_date='',
              self.$swal("Invalid Date!", (this.selectedLanguage == 'en')?"Start date must be smaller than end date":"Begin datum moet kleiner zijn dan eind datum", "error");
            }
          }
      }
    });
    $('#endDate').datepicker({
      dateFormat: 'dd MM yy',
      //minDate: 0, // disable dates before today
      onSelect:function(selectedDate, datePicker) {
          self.project.end_date = selectedDate;

          if (self.project.start_date) {
            var endDate = new Date(selectedDate).toISOString().slice(0,10);
            var startDate = new Date(self.project.start_date).toISOString().slice(0,10);
            var d1 = new Date(startDate);
            var d2 = new Date(endDate);
            if(d1 > d2){
              self.project.end_date='';
              self.$swal("Invalid Date!", (this.selectedLanguage == 'en')?"End date must be greater than start date":"Eind datum moet groter zijn dan start datum", "error");
            }
          }
      }
    });
    self.loadMap();
  }, //mounted ends here
  data:{
    showNewElementForm: false,
    newElementName: '',
    newTaskName: '',
    lastPushedTask: null,
    message: "hello",
    editZipCode: false,
    selectedLanguage : 'en',
    language,
    project_id: project_id,
    project:{},
    jobs:[],
    searchText: '',
    customers:[],
    supervisors:[],
    inspectors:[],
    areas: [],
    workers: [],
    elements: [],
    errors: [],
    locations: [],
    tasks: [],
    types: [],
    floors: [],
    newJobs: [],
    allWorkers:[],
    allElements:[],
    allTasks:[],
    selected_weeks: [],
    add_selected_weeks: [],
    total_weeks: [],
    selectedType:'Daily',
    editJob: {
      id: null,
      location: '',
      floor_name: '',
      area: null,
      area_id: null,
      worker_id: null,
      worker: {
        'id':'',
        'name':'',
      },
      element: {
        'id':'',
        'name':'',
      },
      task: {
        'id':'',
        'name':'',
      },
      element_id: null,
      element_name: null,
      task_id: null,
      task_name: null,
      type: null,
      mon: null,
      tue: null,
      wed: null,
      thu: null,
      fri: null,
      sat: null,
      sun: null,
      workingDay: 'mon'
    },
    addJob: {
      id: null,
      location: '',
      floor_id: '',
      floor_name: '',
      areas: [],
      area: null,
      area_id: null,
      worker_id: null,
      worker: null,
      element_id: null,
      element_name: null,
      task_id: null,
      task_name: null,
      type: null,
      mon: null,
      tue: null,
      wed: null,
      thu: null,
      fri: null,
      sat: null,
      sun: null,
      workingDay: 'mon'
    },
  },
  computed: {
    isInputDisabled() {
      //return this.locations.length === 1;
    }
  }, //data here
  methods: {
    addNewElement() {
      let highestelementId = 0;
      let highestaskId = 0;

      axios.get(APP_URL + '/allelements')
      .then(response => {

        //console.log('response:',response.data);
        highestelementId = Math.max(...response.data.map(element => element.id));
        //console.log(highestelementId);

        // if(this.selectedLanguage == 'en'){
        //
        //   console.log("Elements Before Push" , this.allElements);
        //   console.log("New Element" , this.newElementName);
        //
        //     this.allElements.push({
        //     id: highestelementId + 1,
        //     name_eng: this.newElementName,
        //     displayName: this.newElementName,
        //
        //   });
        //
        //   console.log("Elements after push" , this.allElements);
        // }
        //
        // else {

            this.allElements.push({
            id: highestelementId +1,
            name: this.newElementName,
            displayName: this.newElementName,
          });


        //}

    });

    axios.get(APP_URL + '/alltasks')
    .then(response => {

      //console.log('response:',response.data);
      highestaskId = Math.max(...response.data.map(task => task.id));
      //console.log(highestaskId);


            // if(this.selectedLanguage == 'en'){
            //     this.allTasks.push({
            //     id: highestaskId +1,
            //     name_eng: this.newTaskName,
            //     displayName: this.newTaskName,
            //   });
            //   //update lastPushedTask to newly added task
            //   this.lastPushedTask = this.allTasks[this.allTasks.length - 1];
            //
            // }
            // else{
                this.allTasks.push({
                id: highestaskId +1,
                name: this.newTaskName,
                displayName: this.newTaskName,
              });
              this.lastPushedTask = this.allTasks[this.allTasks.length - 1];
            //}

            this.newElementName = ''
            this.newTaskName = ''


    });
      //console.log(this.elements);
      //console.log(this.tasks);
      //this.newElementName = ''
      //this.newTaskName = ''
      this.showNewElementForm = false
    },
    editPostcode(){
      this.project.city= '';
      this.project.address= '';
      this.editZipCode = true;
    },//editPostcode ends here

    matchesSearch(day) {
      const searchText = this.searchText.trim().toLowerCase();
      if (searchText === '') {
        return true; // Show all rows when the search text is empty
      }
  
      // Check if any of the row's data contains the search text
      return (
        day.area_name.toLowerCase().includes(searchText) ||
        day.worker.toLowerCase().includes(searchText) ||
        day.location.toLowerCase().includes(searchText) ||
        day.element_name.toLowerCase().includes(searchText) ||
        day.type.toLowerCase().includes(searchText) ||
        day.task_name.toLowerCase().includes(searchText)
      );
    },

    getAddress(){
      this.project.city= '';
      this.project.address= '';
      axios.post(APP_URL+`getAddressFromPostCode`,{
        'postcode' : this.project.postcode,
        'houseNumber' : this.project.houseNumber,
      }).then(response=>{
        console.log('response:',response.data);
        this.project.city = response.data.address.city;
        this.project.address = response.data.address.street;
        this.editZipCode = false;
      })
      .catch(error=>{
        console.log('error:',error);
        this.$swal("Error!", (this.selectedLanguage == 'en')?"Invalid zip code or house number" : "Ongeldige postcode of huisnummer", "error");
      })
    },//getAddress ends here

    // Google Map code starting from here
    loadMap() {
      let thisVar = this;

      let map = new google.maps.Map(document.getElementById('map'), {
      center: {lat:61.180059, lng: -149.822075},
      scrollwheel: false,
      zoom: 4
      })

      let input = document.getElementById('pac-input');
      let types = document.getElementById('type-selector');
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
      let autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      let infowindow = new google.maps.InfoWindow();
      let marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
      });

      autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        let place = autocomplete.getPlace();
        if (!place.geometry) {
          // User entered the name of a Place that was not suggested and
          // pressed the Enter key, or the Place Details request failed.
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }
        // If the place has a geometry, then present it on a map.

        let mapVar = map
        if (place.geometry.viewport) {
          mapVar.fitBounds(place.geometry.viewport);
        } else {
          mapVar.setCenter(place.geometry.location);
          mapVar.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setIcon(/** @type {google.maps.Icon} */({
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        let item_Lat =place.geometry.location.lat();
        let item_Lng= place.geometry.location.lng();
        let item_Location = place.formatted_address;

//Fahad code
        // // Find the location ID associated with the old location
        // let locationId = null;
        // thisVar.jobs.forEach(job => {
        // if (job.location_name === item_Location) {
        //   locationId = job.location_id;
        //   }
        // });

        let entry = {
          'latitude' : item_Lat,
          'longitude' : item_Lng,
          'name' : item_Location,
//          'location_id': locationId,
        }
        let count=0;
        let status=[];

        for (let i=0; i < thisVar.locations.length; i++){
          let check=thisVar.locations[i]['name'].includes(entry.name);
          if (check === true){
            status[count]=true;
          }
          if (check === false) {
            status[count]=false;
          }
          count++;

        }
        if (status.includes(true)){
          alert('Sorry this location '+" " + entry.name + " " + ' is Already Exist');
        }
        else {
          //thisVar.locations.push(entry);
          thisVar.$set(thisVar.locations, 0, entry);
        }

        // thisVar.jobs.days.forEach(day => {
        //   if (day.location_id === entry.location_id) {
        //     day.location = entry.name;
        //   }
        // });

        // Check if there is at least one location in the array
      //   if (thisVar.locations.length > 0) {
      // // Update the first location in the array
      //   thisVar.$set(thisVar.locations, 0, entry);
      // // You can update other properties of the location here if needed
      //   }

        console.log(thisVar.locations);
        console.log(thisVar.jobs.days);

        // thisVar.locations.push(entry);

        let address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      });

      // Sets a listener on a radio button to change the filter type on Places
      // Autocomplete.
      function setupClickListener(id, types) {
        let radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function() {
          autocomplete.setTypes(types);
        });
      }
      setupClickListener('changetype-all', []);
      setupClickListener('changetype-address', ['address']);
      setupClickListener('changetype-establishment', ['establishment']);
      setupClickListener('changetype-geocode', ['geocode']);
    }, // loadMap ends here

    // Google Map code ends here

    getProjectDetail(){
      axios.get(APP_URL + `projectDetails/${project_id}`).then(response => {
        console.log('project details :',response.data);
        this.project = response.data.data.project;
        this.customers = response.data.data.customers;
        this.supervisors = response.data.data.supervisors;
        this.inspectors = response.data.data.inspectors;
        this.jobs = response.data.data.project.jobs;
        this.workers = response.data.data.workers;
        this.allWorkers = response.data.data.workers;
        this.locations = response.data.data.project.locations;
        this.workers = this.workers.map((worker) => ({
            ...worker,
            label: `${worker.employee_code} - ${worker.name}`,
        }));        

        console.log('Projects details:',this.project);
        console.log('locations details:',this.locations);
        console.log('Jobs details:', this.jobs);
        // console.log('Selected weeks: ', this.selected_weeks);
      }).catch(error=>{

      })//axios ends here
    }, // getProjectDetail ends here

    editJobMethod(day) {

      this.editJob.id           = day.id;
      this.editJob.area         = day.area;
      this.editJob.location     = day.location;
      this.editJob.worker.id    = day.worker_id;
      this.editJob.worker.name  = day.worker;
      this.editJob.worker       = day.employee_code + " - " + day.worker;
      this.editJob.worker.label = day.employee_code + " - " + day.worker;
      this.editJob.element.id   = day.element_id;
      this.editJob.element.name = day.element_name;
      this.editJob.task.id      = day.task_id;
      this.editJob.task.name  = day.task_name;
      this.editJob.task_name  = day.task_name;
      this.editJob.mon        = (day.mon == 1) ? true:false;
      this.editJob.tue        = (day.tue == 1) ? true:false;
      this.editJob.wed        = (day.wed == 1) ? true:false;
      this.editJob.thu        = (day.thu == 1) ? true:false;
      this.editJob.fri        = (day.fri == 1) ? true:false;
      this.editJob.sat        = (day.sat == 1) ? true:false;
      this.editJob.sun        = (day.sun == 1) ? true:false;
      this.editJob.type        = day.type;
      this.editJob.workingDay = (day.type == 'daily') ? '' : 'mon'

      axios.get(APP_URL + `dayDetails/${day.id}`).then(response => {
        this.editJob.floor_name      = response.data.data.floor_name;
        this.areas    = response.data.data.areas;
        this.elements  = response.data.data.elements;
        this.tasks    = response.data.data.tasks;
        this.types    = response.data.data.types;
        this.selected_weeks = response.data.data.day.week_number;
        this.localizeTypes();

        if (this.editJob.type == 'weekly') {
          this.editJob.workingDay = response.data.data.workingDay
        }
      })
      .catch(error => {
        console.log(error);
      })
    }, // editJob ends here
    saveEditModel() {
      this.editJob.area_id    = this.editJob.area.id;
      this.editJob.worker_id  = this.editJob.worker.id;
      this.editJob.element_id = this.editJob.element.id;
      this.editJob.task_id    = this.editJob.task.id;
      this.editJob.week_number = this.selected_weeks;

      if (this.editJob.type === 'daily' && !(this.editJob.mon || this.editJob.tue || this.editJob.wed || this.editJob.thu || this.editJob.fri || this.editJob.sat || this.editJob.sun) ) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Work Day, For Job":"Selecteer dagen, voor nieuwe taak", "error");
      }else if(this.editJob.type ==='weekly'&& this.selected_weeks.length === 0 ) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select week number for job!":"Selecteer weeknummer voor taak", "error");
      }else {
        axios.post(APP_URL + `saveEditJob/${this.editJob.id}`, this.editJob)
        .then(response => {
          this.getProjectDetail();
          this.$swal("Good job!", (this.selectedLanguage == 'en')?"Job updated successfuly!":"Taak bijgewerkt", "success");
        })
        .catch(error => {
          this.$swal("Error!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
        })
      }
    }, // saveEditModel ends

    supervisorChanged(){
      let id = this.project.supervisor_id;
      this.workers = [];
      axios.get(APP_URL + `getRelatedWorkers/${id}`).then(response => {
        this.workers = response.data.data.workers;
        this.allWorkers = response.data.data.workers;
      })
      .catch(error => {
        console.log(error);
      })
    }, // supervisorChanged ends here

    typeIsChanged() {
      console.log(this.addJob.type);
      this.editJob.workingDay = 'mon'
      this.add_selected_weeks = [];
      this.editJob.mon        = null;
      this.editJob.tue        = null;
      this.editJob.wed        = null;
      this.editJob.thu        = null;
      this.editJob.fri        = null;
      this.editJob.sat        = null;
      this.editJob.sun        = null;

      this.addJob.workingDay = 'mon';
      this.addJob.mon        = null;
      this.addJob.tue        = null;
      this.addJob.wed        = null;
      this.addJob.thu        = null;
      this.addJob.fri        = null;
      this.addJob.sat        = null;
      this.addJob.sun        = null;

    }, // typeIsChanged ends here

    closeEditModel() {
      this.editJob.floor_name = null;
      this.editJob.area       = null;
      this.editJob.area_id    = null;
      this.editJob.worker_id  = null;
      this.editJob.task_id    = null;
      this.editJob.task_name  = null;
      this.editJob.mon        = null;
      this.editJob.tue        = null;
      this.editJob.wed        = null;
      this.editJob.thu        = null;
      this.editJob.fri        = null;
      this.editJob.sat        = null;
      this.editJob.sun        = null;
    }, // close Edit Model ends here

    addJobMethod() {
      this.closeAddModel();
      axios.get(APP_URL + `addDayDetails`).then(response => {
        this.floors = response.data.data.floors;
        this.areas = response.data.data.areas;
        this.allWorkers = response.data.data.workers;

        this.allElements = response.data.data.elements.filter(element => element.name !== null);
        this.allElements.forEach(element => {
            element.displayName = element.name;
        });

        this.allWorkers = this.allWorkers.map((worker) => ({
            ...worker,
            label: `${worker.employee_code} - ${worker.name}`,
        }));        


        //this.allTasks = response.data.data.tasks;
        this.types = response.data.data.types;
        this.localizeTypes();

      })
      .catch(error => {
        console.log(error);
      })
    }, // addJobMethod ends here

    floorChanged(value) {
      console.log("test element");
      this.addJob.areas = [];
      axios.get(APP_URL + `getRelatedAreas/${value.id}`).then(response => {
        this.addJob.areas = response.data.data.areas;
      })
      .catch(error => {
        console.log(error);
      })
    }, // floorChanged ends here
    elementChanged() {

      //console.log("test element");
      console.log('Selected Element:', this.addJob.element_id.id);
      //this.element_type = [];


      //this.areas = [];
      axios.get(APP_URL + `getRelatedTasks/${this.addJob.element_id.id}`).then(response => {

      // if (this.selectedLanguage === 'en') {
      //     this.allTasks = response.data.data.tasks.filter(task => task.name_eng !== null);
      //     this.allTasks.forEach(task => {
      //
      //     task.displayName = task.name_eng;
      //
      //     });
      //     if (this.lastPushedTask && !this.allTasks.includes(this.lastPushedTask)) {
      //       this.allTasks.push(this.lastPushedTask);
      //     }
      //
      // }
      // else {

        this.allTasks = response.data.data.tasks.filter(task => task.name !== null);

          this.allTasks.forEach(task => {

            task.displayName = task.name;

      });
      if (this.lastPushedTask && !this.allTasks.includes(this.lastPushedTask)) {
        this.allTasks.push(this.lastPushedTask);
      }


//      }

      //this.allTasks = response.data.data.tasks;

      //console.log(response.data);

      })
      .catch(error => {
        console.log(error);
      })
    },

    addMoreLocation(){
      document.getElementById('pac-input').value="";
    }, // addMoreLocation ends here

    removeLocation(index){
      swal({
              title: (this.selectedLanguage == 'en')?"Are you sure?":"Weet je dat zeker?",
              text: (this.selectedLanguage == 'en')?"All jobs on this locations would be deleted":"Alle taken op deze locaties zouden worden verwijderd",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                let self = this;
                let jobs = this.jobs;
                let location_name = this.locations[index]['name'];
                jobs.forEach(function(job,index) {
                  job.days.forEach(function(item,ind) {
                    if(item.location === location_name){
                      //////deleted permanently days table entry///////
                      axios.get(APP_URL + `project/deleteJob/${item.id}/${project_id}`)
                      .then(response=>{
                        job.days.splice(ind,1);
                      })
                      .catch(error=>{
                        console.log(error);
                      });
                      //////deleted permanently days table entry///////
                    }
                  });
                });//nested foreach loop to delete tasks in jobs array

                this.newJobs.forEach(function(item,ind) {
                  if(item.location.name === location_name){
                    self.newJobs.splice(ind,1);
                  }
                });
                this.locations.splice(index,1);
                swal((this.selectedLanguage == 'en')?"Location and linked jobs deleted successfuly":"Locatie en gekoppelde taken succesvol verwijderd", {
                  icon: "success",
                });
              }
            });

    }, // removeLocation ends here

    removeJob(id,job_index,day_index){
      console.log('removeJob called id=',id);

      /////this api call deletes entry from days table
      swal({
              title: (this.selectedLanguage == 'en')?"Are you sure?":"Weet je dat zeker?",
              text: (this.selectedLanguage == 'en')?"Once deleted, you will not be able to recover this task":"Na verwijdering kunt u deze taak niet meer herstellen",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                axios.get(APP_URL + `project/deleteJob/${id}/${project_id}`)
                .then(response=>{
                  let day = this.jobs[job_index]['days']
                  day.splice(day_index,1);
                  swal("successfully deleted (Succesvol verwijderd)!", {
                    icon: "success",
                  });
                  // this.getProjectDetail();
                })
                .catch(error=>{
                  console.log(error);
                });
              }
            });
    },//removeJob ends here

    closeAddModel() {
      this.addJob.id = null;
      // this.allWorkers = [];
      this.floors = [];
      this.add_selected_weeks = [];
      this.types = [];
      this.allElements = [];
      this.allTasks = [];
      this.addJob.floor_id = '';
      this.addJob.floor_name = '';
      this.addJob.areas = [];
      this.addJob.area = null;
      this.addJob.area_id = '';
      this.addJob.worker_id = '';
      this.addJob.worker = null;
      this.addJob.element_id = '';
      this.addJob.element_name = null;
      this.addJob.task_id = '';
      this.addJob.task_name = null;
      if (this.language === 'en') {
        this.addJob.type = 'Daily';
      } else {
        this.addJob.type = 'Dagelijks';
      }
      // this.addJob.type = 'Daily';
      this.addJob.mon = null;
      this.addJob.tue = null;
      this.addJob.wed = null;
      this.addJob.thu = null;
      this.addJob.fri = null;
      this.addJob.sat = null;
      this.addJob.sun = null;
      this.addJob.workingDay = 'mon';

    }, // ends here

    AddJobTemp() {
      if(!this.addJob.floor_id){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select floor for new job":"Selecteer ruimte type, voor nieuwe taak", "error");
      }else if (!this.addJob.area_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select area for new job!":"Kies ruimte, voor nieuwe taak", "error");
      }else if (!this.addJob.location) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select location for new job!":"Kies Locatie, voor nieuwe taak", "error");
      }else if (!this.addJob.worker_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select worker for new job!":"Kies arbeider, voor nieuwe taak", "error");
      }else if (!this.addJob.element_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select element for new job!":"Kies element, voor nieuwe taak", "error");
      }else if (!this.addJob.task_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select task for new job!":"Kies taak, voor nieuwe taak", "error");
      }else if (!this.addJob.type) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select job Type for new job!":"Kies soort taak, voor nieuwe taak", "error");
      }else{
        if (this.addJob.type === 'Daily' && !(this.addJob.mon || this.addJob.tue || this.addJob.wed || this.addJob.thu || this.addJob.fri || this.addJob.sat || this.addJob.sun) ) {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select work day for new job!":"Selecteer dagen, voor nieuwe taak", "error");
        }else if(this.addJob.type ==='Weekly'&& this.add_selected_weeks.length === 0 ) {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select work day for new job!":"Selecteer dagen, voor nieuwe taak", "error");
        }else {
          let newSingleJob = {
            location: this.addJob.location,
            floor_name: this.addJob.floor_id.name,
            floor_id: this.addJob.floor_id.id,
            area_id: this.addJob.area_id.id,
            area: this.addJob.area_id.name,
            worker_id: this.addJob.worker_id.id,
            worker: this.addJob.worker_id.name,
            element_id: this.addJob.element_id.id,
            element_name: this.addJob.element_id.name,
            task_id: this.addJob.task_id.id,
            task_name: this.addJob.task_id.name,
            type: this.addJob.type,
            mon: this.addJob.mon,
            tue: this.addJob.tue,
            wed: this.addJob.wed,
            thu: this.addJob.thu,
            fri: this.addJob.fri,
            sat: this.addJob.sat,
            sun: this.addJob.sun,
            workingDay: this.addJob.workingDay,
            week_number: this.add_selected_weeks,
          };

          this.newJobs.push(newSingleJob);
          this.addJob.floor_id = this.addJob.floor_id;
          this.addJob.area_id = this.addJob.area_id;
          this.addJob.worker_id = this.addJob.worker_id;
          this.addJob.element_id = this.addJob.element_id;
          this.addJob.task_id = this.addJob.task_id;
          this.addJob.mon = null;
          this.addJob.tue = null;
          this.addJob.wed = null;
          this.addJob.thu = null;
          this.addJob.fri = null;
          this.addJob.sat = null;
          this.addJob.sun = null;
          this.$swal("Good job!", (this.selectedLanguage == 'en')?"New Job Added successfuly":"Nieuwe taak toegevoegdd", "success");
        }
      }
    }, // AddJobTemp ends here

    removeNewJob(key){
      this.newJobs.splice(key,1);
    },// removeNewJob(key) ends here

    updateProjectDetails() {
      axios.post(APP_URL + `updateProjectDetails/${this.project_id}`, {
        project_id: this.project_id,
        name: this.project.name,
        description: this.project.description,
        customer_id: this.project.customer_id,
        supervisor_id: this.project.supervisor_id,
        inspector_id: this.project.inspector_id,
        phone: this.project.phone,
        address: this.project.address,
        city: this.project.city,
        zipcode: this.project.zipcode,
        houseNumber: this.project.houseNumber,
        postcode: this.project.postcode,
        country: this.project.country,
        fax: this.project.fax,
        notes: this.project.notes,
        weekcard: this.project.weekcard,
        start_date: this.project.start_date,
        end_date: this.project.end_date,
        break: this.project.break,
        code: this.project.code,
        newJobs: this.newJobs,
        jobs: this.jobs,
        locations: this.locations,
      })
      .then(response => {
        console.log('response ',response.data);
        this.$swal("Good job!", "Project Detail Edited!", "success");
        this.$swal("Good job!", (this.selectedLanguage == 'en')?"Project detail updated successfuly":"Projectdetail succesvol bijgewerkt", "success");
        if(response.data.status == 1){
          setTimeout(function(){
            window.location.href = APP_URL + `project`;
          }, 2000);
        }
        this.errors = '';
      })
      .catch(error => {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
        this.errors = error.response.data.errors;
      })
    }, // updateProjectDetails end here
    localizeTypes() {
      if(this.language === 'en') {
        this.types        = {'daily' : 'Daily','weekly' : 'Weekly','one-time' : 'One-Time','extra' : 'Extra'};
      } else {
        this.types        = {'daily' : 'Dagelijks','weekly' : 'Wekelijks','one-time' : 'Eenmalig','extra' : 'Extra'};
      }

    }, // localizeTypes ends here

  },//methods ending here

});
