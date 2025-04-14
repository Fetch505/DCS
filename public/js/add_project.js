Vue.component('v-select', VueSelect.VueSelect);
Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);

new Vue({
  el: '#add_project',
  created(){
    // this.getDetails();
    //
    // let i = 1;
    // for (i = 1; i <= 52; i++) {
    //   this.total_weeks.push(i)
    // }

  },
  mounted(){
    this.project.country = this.countries.NL;
    this.selectedLanguage = this.$refs.language.value;

    this.getDetails();

    let i = 1;
    for (i = 1; i <= 52; i++) {
      this.total_weeks.push(i)
    }

    //console.log(this.selectedLanguage);
    this.localizeTypes();
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
    // map:'',
    showNewElementForm: false,
    newElementName: '',
    newTaskName: '',
    lastPushedTask: null,
    message:"Hello world",
    total_weeks: [],
    selected_weeks: [],
    language,
    countries:
    {
      'AF': 'Afghanistan',
      'AX': 'Aland Islands',
      'AL': 'Albania',
      'DZ': 'Algeria',
      'AS': 'American Samoa',
      'AD': 'Andorra',
      'AO': 'Angola',
      'AI': 'Anguilla',
      'AQ': 'Antarctica',
      'AG': 'Antigua And Barbuda',
      'AR': 'Argentina',
      'AM': 'Armenia',
      'AW': 'Aruba',
      'AU': 'Australia',
      'AT': 'Austria',
      'AZ': 'Azerbaijan',
      'BS': 'Bahamas',
      'BH': 'Bahrain',
      'BD': 'Bangladesh',
      'BB': 'Barbados',
      'BY': 'Belarus',
      'BE': 'Belgium',
      'BZ': 'Belize',
      'BJ': 'Benin',
      'BM': 'Bermuda',
      'BT': 'Bhutan',
      'BO': 'Bolivia',
      'BA': 'Bosnia And Herzegovina',
      'BW': 'Botswana',
      'BV': 'Bouvet Island',
      'BR': 'Brazil',
      'IO': 'British Indian Ocean Territory',
      'BN': 'Brunei Darussalam',
      'BG': 'Bulgaria',
      'BF': 'Burkina Faso',
      'BI': 'Burundi',
      'KH': 'Cambodia',
      'CM': 'Cameroon',
      'CA': 'Canada',
      'CV': 'Cape Verde',
      'KY': 'Cayman Islands',
      'CF': 'Central African Republic',
      'TD': 'Chad',
      'CL': 'Chile',
      'CN': 'China',
      'CX': 'Christmas Island',
      'CC': 'Cocos (Keeling) Islands',
      'CO': 'Colombia',
      'KM': 'Comoros',
      'CG': 'Congo',
      'CD': 'Congo, Democratic Republic',
      'CK': 'Cook Islands',
      'CR': 'Costa Rica',
      'CI': 'Cote D\'Ivoire',
      'HR': 'Croatia',
      'CU': 'Cuba',
      'CY': 'Cyprus',
      'CZ': 'Czech Republic',
      'DK': 'Denmark',
      'DJ': 'Djibouti',
      'DM': 'Dominica',
      'DO': 'Dominican Republic',
      'EC': 'Ecuador',
      'EG': 'Egypt',
      'SV': 'El Salvador',
      'GQ': 'Equatorial Guinea',
      'ER': 'Eritrea',
      'EE': 'Estonia',
      'ET': 'Ethiopia',
      'FK': 'Falkland Islands (Malvinas)',
      'FO': 'Faroe Islands',
      'FJ': 'Fiji',
      'FI': 'Finland',
      'FR': 'France',
      'GF': 'French Guiana',
      'PF': 'French Polynesia',
      'TF': 'French Southern Territories',
      'GA': 'Gabon',
      'GM': 'Gambia',
      'GE': 'Georgia',
      'DE': 'Germany',
      'GH': 'Ghana',
      'GI': 'Gibraltar',
      'GR': 'Greece',
      'GL': 'Greenland',
      'GD': 'Grenada',
      'GP': 'Guadeloupe',
      'GU': 'Guam',
      'GT': 'Guatemala',
      'GG': 'Guernsey',
      'GN': 'Guinea',
      'GW': 'Guinea-Bissau',
      'GY': 'Guyana',
      'HT': 'Haiti',
      'HM': 'Heard Island & Mcdonald Islands',
      'VA': 'Holy See (Vatican City State)',
      'HN': 'Honduras',
      'HK': 'Hong Kong',
      'HU': 'Hungary',
      'IS': 'Iceland',
      'IN': 'India',
      'ID': 'Indonesia',
      'IR': 'Iran, Islamic Republic Of',
      'IQ': 'Iraq',
      'IE': 'Ireland',
      'IM': 'Isle Of Man',
      'IL': 'Israel',
      'IT': 'Italy',
      'JM': 'Jamaica',
      'JP': 'Japan',
      'JE': 'Jersey',
      'JO': 'Jordan',
      'KZ': 'Kazakhstan',
      'KE': 'Kenya',
      'KI': 'Kiribati',
      'KR': 'Korea',
      'KW': 'Kuwait',
      'KG': 'Kyrgyzstan',
      'LA': 'Lao People\'s Democratic Republic',
      'LV': 'Latvia',
      'LB': 'Lebanon',
      'LS': 'Lesotho',
      'LR': 'Liberia',
      'LY': 'Libyan Arab Jamahiriya',
      'LI': 'Liechtenstein',
      'LT': 'Lithuania',
      'LU': 'Luxembourg',
      'MO': 'Macao',
      'MK': 'Macedonia',
      'MG': 'Madagascar',
      'MW': 'Malawi',
      'MY': 'Malaysia',
      'MV': 'Maldives',
      'ML': 'Mali',
      'MT': 'Malta',
      'MH': 'Marshall Islands',
      'MQ': 'Martinique',
      'MR': 'Mauritania',
      'MU': 'Mauritius',
      'YT': 'Mayotte',
      'MX': 'Mexico',
      'FM': 'Micronesia, Federated States Of',
      'MD': 'Moldova',
      'MC': 'Monaco',
      'MN': 'Mongolia',
      'ME': 'Montenegro',
      'MS': 'Montserrat',
      'MA': 'Morocco',
      'MZ': 'Mozambique',
      'MM': 'Myanmar',
      'NA': 'Namibia',
      'NR': 'Nauru',
      'NP': 'Nepal',
      'NL': 'Netherlands',
      'AN': 'Netherlands Antilles',
      'NC': 'New Caledonia',
      'NZ': 'New Zealand',
      'NI': 'Nicaragua',
      'NE': 'Niger',
      'NG': 'Nigeria',
      'NU': 'Niue',
      'NF': 'Norfolk Island',
      'MP': 'Northern Mariana Islands',
      'NO': 'Norway',
      'OM': 'Oman',
      'PK': 'Pakistan',
      'PW': 'Palau',
      'PS': 'Palestinian Territory, Occupied',
      'PA': 'Panama',
      'PG': 'Papua New Guinea',
      'PY': 'Paraguay',
      'PE': 'Peru',
      'PH': 'Philippines',
      'PN': 'Pitcairn',
      'PL': 'Poland',
      'PT': 'Portugal',
      'PR': 'Puerto Rico',
      'QA': 'Qatar',
      'RE': 'Reunion',
      'RO': 'Romania',
      'RU': 'Russian Federation',
      'RW': 'Rwanda',
      'BL': 'Saint Barthelemy',
      'SH': 'Saint Helena',
      'KN': 'Saint Kitts And Nevis',
      'LC': 'Saint Lucia',
      'MF': 'Saint Martin',
      'PM': 'Saint Pierre And Miquelon',
      'VC': 'Saint Vincent And Grenadines',
      'WS': 'Samoa',
      'SM': 'San Marino',
      'ST': 'Sao Tome And Principe',
      'SA': 'Saudi Arabia',
      'SN': 'Senegal',
      'RS': 'Serbia',
      'SC': 'Seychelles',
      'SL': 'Sierra Leone',
      'SG': 'Singapore',
      'SK': 'Slovakia',
      'SI': 'Slovenia',
      'SB': 'Solomon Islands',
      'SO': 'Somalia',
      'ZA': 'South Africa',
      'GS': 'South Georgia And Sandwich Isl.',
      'ES': 'Spain',
      'LK': 'Sri Lanka',
      'SD': 'Sudan',
      'SR': 'Suriname',
      'SJ': 'Svalbard And Jan Mayen',
      'SZ': 'Swaziland',
      'SE': 'Sweden',
      'CH': 'Switzerland',
      'SY': 'Syrian Arab Republic',
      'TW': 'Taiwan',
      'TJ': 'Tajikistan',
      'TZ': 'Tanzania',
      'TH': 'Thailand',
      'TL': 'Timor-Leste',
      'TG': 'Togo',
      'TK': 'Tokelau',
      'TO': 'Tonga',
      'TT': 'Trinidad And Tobago',
      'TN': 'Tunisia',
      'TR': 'Turkey',
      'TM': 'Turkmenistan',
      'TC': 'Turks And Caicos Islands',
      'TV': 'Tuvalu',
      'UG': 'Uganda',
      'UA': 'Ukraine',
      'AE': 'United Arab Emirates',
      'GB': 'United Kingdom',
      'US': 'United States',
      'UM': 'United States Outlying Islands',
      'UY': 'Uruguay',
      'UZ': 'Uzbekistan',
      'VU': 'Vanuatu',
      'VE': 'Venezuela',
      'VN': 'Viet Nam',
      'VG': 'Virgin Islands, British',
      'VI': 'Virgin Islands, U.S.',
      'WF': 'Wallis And Futuna',
      'EH': 'Western Sahara',
      'YE': 'Yemen',
      'ZM': 'Zambia',
      'ZW': 'Zimbabwe',
    },
    phone:null,
    selectedLanguage : 'en',
    project:{
      name: '',
      desc: '',
      customer_id : '',
      supervisor_id : '',
      inspector_id : '',
      phone: '',
      address: '',
      city: '',
      zipcode: '',
      country: '',
      fax: '',
      notes: '',
      weekcard: '',
      start_date: '',
      end_date: '',
      break: '',
      code: '',
      postcode: '',
      houseNumber: '',
    },
    job:{
      location:'',
      floor_id:'',
      floor_name:'',
      area_id:'',
      area_name:'',
      element_id:'',
      element_name:'',
      element_type_id:'',
      element_type_name:'',
      worker_id:'',
      worker_name:'',
      task_id:'',
      task_name:'',
      type_name:'daily',
      mon:'',
      tue:'',
      wed:'',
      thu:'',
      fri:'',
      sat:'',
      sun:'',
      workingDay:'mon',
    },
    customers:[],
    supervisors:[],
    inspectors:[],
    floors:[],
    locations:[],
    elements:[],
    errors:[],
    workers:[],
    tasks:[],
    tempJobs:[],
    areas:[],
    element_type:[],
    types:{'daily' : 'Daily','weekly' : 'Weekly'},
    selectedType:'daily',

  },
  computed: {
    isInputDisabled() {
      return this.locations.length === 1;
    }
  },
  methods:{
    checkDate(){
      console.log('check date called');
    },
    addNewElement() {
      let highestelementId = 0;
      let highestaskId = 0;

      axios.get(APP_URL + '/allelements')
      .then(response => {

        //console.log('response:',response.data);
        highestelementId = Math.max(...response.data.map(element => element.id));
        //console.log(highestelementId);

        if(this.selectedLanguage == 'en'){

          //console.log("Elements Before Push" , this.elements);
          //console.log("New Element" , this.newElementName);

            this.elements.push({
            id: highestelementId + 1,
            name: this.newElementName,
            displayName: this.newElementName,

          });

          //console.log("Elements after push" , this.elements);
        }

        else {

            this.elements.push({
            id: highestelementId +1,
            name: this.newElementName,
            displayName: this.newElementName,
          });


        }

    });

    axios.get(APP_URL + '/alltasks')
    .then(response => {

      //console.log('response:',response.data);
      highestaskId = Math.max(...response.data.map(task => task.id));
      //console.log(highestaskId);


            if(this.selectedLanguage == 'en'){
                this.tasks.push({
                id: highestaskId +1,
                name: this.newTaskName,
                displayName: this.newTaskName,
              });
              //update lastPushedTask to newly added task
              this.lastPushedTask = this.tasks[this.tasks.length - 1];

            }
            else{
                this.tasks.push({
                id: highestaskId +1,
                name: this.newTaskName,
                displayName: this.newTaskName,
              });
              this.lastPushedTask = this.tasks[this.tasks.length - 1];
            }

            this.newElementName = ''
            this.newTaskName = ''


    });
      //console.log(this.elements);
      //console.log(this.tasks);
      //this.newElementName = ''
      //this.newTaskName = ''
      this.showNewElementForm = false
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
      })
      .catch(error=>{
        console.log('error:',error);
        this.$swal("Error!", (this.selectedLanguage == 'en')?"Invalid zip code or house number" : "Ongeldige postcode of huisnummer", "error");
      })
    },//getAddress ends here

    // Google Map code starting from here
    loadMap() {
      let thisVar = this;
      // console.log("map: ", google.maps)
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
        // console.log("map", map);
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

        // console.log('lat',item_Lat);
        // console.log('item_Lng',item_Lat);
        // console.log('item_Location',item_Lat);

        let entry = {
          'latitude' : item_Lat,
          'longitude' : item_Lng,
          'name' : item_Location,
        }

        thisVar.locations.push(entry);

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
    getDetails(){
      //console.log(this.selectedLanguage);
      axios.get(APP_URL + `getDetails`).then(response=>{
        //const filteredElements = response.data.data.elements.filter(element => element.name_eng !== null);
        //console.log(filteredElements);
        //return;
        this.customers = response.data.data.customers;
        this.floors = response.data.data.floors;

        this.elements = response.data.data.elements.filter(element => element.name !== null);

        this.elements.forEach(element => {
          element.displayName = element.name;
        });

        this.tasks = response.data.data.tasks;
        this.workers = response.data.data.workers;
        this.supervisors = response.data.data.supervisors;
        this.inspectors = response.data.data.inspectors;
        this.areas = response.data.data.areas;
        this.workers = this.workers.map((worker) => ({
            ...worker,
            label: `${worker.employee_code} - ${worker.name}`,
        }));
      }).catch(error=>{
        console.log(error);
      })
    },//getDetails ends here

    addMoreLocation(){
      // console.log('document.getElementById :',document.getElementById('pac-input'));
      document.getElementById('pac-input').value="";
    }, // addMoreLocation ends here

    removeLocation(index){
      this.locations.splice(index,1);
    }, // removeLocation ends here

    onUpdate(payload){
      this.phone = payload;
      this.project.country = this.countries[payload.countryCode];
    },

    createProject(){
      if (this.phone && !this.phone.isValid){
         this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please add valid phone number":"Voeg een geldig telefoonnummer toe", "error");
         return null;
      }
      if (!this.phone){
         this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please add valid phone number":"Voeg een geldig telefoonnummer toe", "error");
         return null;
      }
      if (!this.project.break) {
        this.project.break = 0;
      }
      // console.log('Jobs: ', this.tempJobs)
      axios.post(APP_URL + `addProject`,{
        name: this.project.name,
        description: this.project.desc,
        customer_id: this.project.customer_id,
        supervisor_id: this.project.supervisor_id,
        inspector_id: this.project.inspector_id,
        phone: this.phone? this.phone.formattedNumber:null,
        address: this.project.address,
        city: this.project.city,
        zipcode: this.project.zipcode,
        postcode: this.project.postcode,
        houseNumber: this.project.houseNumber,
        country: this.project.country,
        fax: this.project.fax,
        notes: this.project.notes,
        weekcard: this.project.weekcard,
        start_date: this.project.start_date,
        end_date: this.project.end_date,
        break: this.project.break,
        code: this.project.code,
        locations: this.locations,
        jobs: this.tempJobs
      }).then(response=>{
        //console.log('data ', response.data);
        // this.$swal("Good job!", "New Project Created!, (Nieuw project gemaakt)", "success");
        this.$swal("Good job!", (this.selectedLanguage == 'en')?"New project created successfuly":"Nieuw project gemaakt", "success");

        if(response.data.status == 1){
          setTimeout(function(){
            window.location.href = APP_URL + `project`;
          }, 2000);
        }
        this.errors = '';
      }).catch(error=>{
        this.$swal("Ooops!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
        this.errors = error.response.data.errors;
      })
    },//create project ends here

    supervisorChanged(){
      // console.log('supervisorChanged');
      let id = this.project.supervisor_id;
      this.workers = [];
      axios.get(APP_URL + `getRelatedWorkers/${id}`).then(response => {
        // console.log('workers :', response.data.data.workers);
        this.workers = response.data.data.workers;
      })
      .catch(error => {
        console.log(error);
      })
    }, // supervisorChanged ends here

    floorChanged(value) {
      this.areas = [];
      axios.get(APP_URL + `getRelatedAreas/${value.id}`).then(response => {
        this.areas = response.data.data.areas;
      })
      .catch(error => {
        console.log(error);
      })
    }, // floorChanged ends here
    elementChanged() {

      //console.log('Selected Element:', this.job.element_id.id);
      //console.log(this.selectedLanguage);


      axios.get(APP_URL + `getRelatedTasks/${this.job.element_id.id}`)
      .then(response => {
      //this.elements = response.data.data.elements.filter(element => element.name_eng !== null);
      // if (this.selectedLanguage === 'en') {
      //   this.tasks = response.data.data.tasks.filter(task => task.name !== null);
      //   this.tasks.forEach(task => {
      //     task.displayName = task.name;
      //     //console.log(task);
      //   });
      //   if (this.lastPushedTask && !this.tasks.includes(this.lastPushedTask)) {
      //     this.tasks.push(this.lastPushedTask);
      //   }
      // } else {
        this.tasks = response.data.data.tasks.filter(task => task.name !== null);
        this.tasks.forEach(task => {
          task.displayName = task.name;
        });

        // if lastPushedTask is not in tasks array, add it to the end
        if (this.lastPushedTask && !this.tasks.includes(this.lastPushedTask)) {
          this.tasks.push(this.lastPushedTask);
        }
      //}
      //this.tasks = tasks;

    })
    .catch(error => {
      console.log(error);
    });


    },
    typeChanged(){
      //console.log("type chanaged");
      this.selectedType   = this.job.type_name;
      this.job.mon        = null;
      this.job.tue        = null;
      this.job.wed        = null;
      this.job.thu        = null;
      this.job.fri        = null;
      this.job.sat        = null;
      this.job.sun        = null;
      // this.workingDay     = '';
    },//type changed ends here

    addTempJob(){
      //console.log("element_type_id:", this.job.element_type_id.name);
      if(!this.job.floor_id){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Floor, For New Job":"Selecteer ruimte type, voor nieuwe taak", "error");
      }else if (!this.job.area_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Area, For New Job!":"Kies ruimte, voor nieuwe taak", "error");
      }else if (!this.job.worker_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Worker, For New Job!":"Kies arbeider, voor nieuwe taak", "error");
      }else if (!this.job.element_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Element, For New Job!":"Kies element, voor nieuwe taak", "error");
      }else if (!this.job.task_id) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Task, For New Job!":"Kies taak, voor nieuwe taak", "error");
      }else if (!this.job.type_name) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Job Type, For New Job!":"Kies soort taak, voor nieuwe taak", "error");
      }else {
        if (this.job.type_name === 'daily' && !(this.job.mon || this.job.tue || this.job.wed || this.job.thu || this.job.fri || this.job.sat || this.job.sun) ) {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please Select Work Day, For New Job!":"Selecteer dagen, voor nieuwe taak", "error");
        }else if(this.job.type_name ==='weekly'&& this.selected_weeks.length === 0 ) {
          this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select week number for new job!":"Selecteer weeknummer voor nieuwe opdracht", "error");
        }else {
          let newSingleJob = {
            floor_name: this.job.floor_id.name,
            location: this.job.location,
            floor_id: this.job.floor_id.id,
            area_id: this.job.area_id.id,
            area_name: this.job.area_id.name,
            worker_id: this.job.worker_id.id,
            worker_name: this.job.worker_id.name,
            element_id: this.job.element_id.id,
            element_name:this.selectedLanguage === 'en' ? this.job.element_id.name : this.job.element_id.name,
            element_type_id: this.job.element_type_id.id,
            element_type_name: this.job.element_type_id.name,
            task_id: this.job.task_id.id,
            task_name: this.selectedLanguage === 'en' ? this.job.task_id.name : this.job.task_id.name,
            type: this.job.type_name,
            mon: this.job.mon,
            tue: this.job.tue,
            wed: this.job.wed,
            thu: this.job.thu,
            fri: this.job.fri,
            sat: this.job.sat,
            sun: this.job.sun,
            workingDay: this.job.workingDay,
            week_number: this.selected_weeks,
          };
          this.tempJobs.push(newSingleJob);
          console.log(this.tempJobs);
          this.selected_weeks = [];
          this.$swal("Good job!", (this.selectedLanguage == 'en')?"New Job Added successfuly":"Nieuwe taak toegevoegdd", "success");
        }
      }
    },//addTempJob ends here

    removeNewJob(key){
      this.tempJobs.splice(key,1);
    },// removeNewJob(key) ends here

    modalClosed(){
      this.selectedType   = 'daily';
      this.selected_weeks  = [];
      this.job.floor_id   = '';
      this.job.area_id    = '';
      this.job.worker_id  = '';
      this.job.element_id = '';
      this.job.task_id    = '';
      this.job.type_name  = 'daily';
      this.job.mon        = '';
      this.job.tue        = '';
      this.job.wed        = '';
      this.job.thu        = '';
      this.job.fri        = '';
      this.job.sat        = '';
      this.job.sun        = '';
      this.job.workingDay = 'mon';
    },//modalClosed ends here
    localizeTypes() {
      if(this.language === 'en') {
        this.types = {'daily' : 'Daily','weekly' : 'Weekly','one-time' : 'One-Time','extra' : 'Extra' };
      } else {
        this.types = {'daily' : 'Dagelijks','weekly' : 'Wekelijks','one-time' : 'Eenmalig','extra' : 'Extra'};
      }
    }, // localizeTypes ends here

  },//methods ends here

})//vue block
