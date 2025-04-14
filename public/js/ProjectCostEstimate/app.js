Vue.use(VueSwal);
Vue.component('v-select', VueSelect.VueSelect);
Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);
new Vue({
  el : '#app',
  data :{
    selectedLanguage : 'en',
    phoneDetails:null,
    project_name:'',
    client_name:'',
    start_date:'',
    end_date:'',
    address:'',
    email:'',
    phone:'',
    shiftType:1,
    contact_person1:'',
    contact_person2:'',
    client_type:'new',
    addNormError:(this.selectedLanguage == 'en')?"Please select factor":"Selecteer een factor",
    computation:false, //this variable for restrinting rate_comp function
    customers:[],
    customersData:[],
    comments:[],
    workerGroups:[],
    tasks:[],
    floor_types:[],
    room_types:[],
    elements:[],
    errors:[],
    selectedTasks:[],
    basciNormTable:[],
    prd_hr_mon_fri_Table:[],
    prd_hr_mon_fri_cal_array:[],
    drt_sup_hr_mon_fri_Table:[],
    space_State_Table:[],
    task_check_status_mon : '',
    task_check_status_tue : '',
    task_check_status_wed : '',
    task_check_status_thu : '',
    task_check_status_fri : '',
    task_check_status_sat : '',
    task_check_status_sun : '',

    element_check_status_mon : '',
    element_check_status_tue : '',
    element_check_status_wed : '',
    element_check_status_thu : '',
    element_check_status_fri : '',
    element_check_status_sat : '',
    element_check_status_sun : '',
    elem_Select_error:false,
    elem_days_error:false,
    calculateButton:true,
    addSpaceStError : (this.selectedLanguage == 'en')?"Please add square meter area":"Voeg een vierkante meter toe",

    prd_hr_mon_fri_total_hour:0.0,
    prd_hr_mon_fri_Total_price:0,
    prd_hr_mon_fri_Total_cost:0,
    prd_hr_mon_fri_Total_hourly_structure:0,
    prd_hr_mon_fri_rate:0,

    drt_sup_hr_mon_fri_total_hour:0.0,
    drt_sup_hr_mon_fri_Total_price:0,
    drt_sup_hr_mon_fri_Total_cost:0,
    drt_sup_hr_mon_fri_Total_hourly_structure:0,
    drt_sup_hr_mon_fri_rate:0,
    element_days_count:0,
    task_days_count:0,
    total_task_freq:0,
    shiftaDay:1,
    standardCalcultaion : false,
    addButton: true,
    worker_group:{
      group:'',
      hourly_rate:'',
      percentage:'',
    },
    drt_sup_worker_group:{
      group:'',
      hourly_rate:'',
      percentage:'',
    },
    task_entry:{
      task:'',
      days_frequency:'',
    },
    element_entry:{
      element:'',
      frequency:'',
    },
    basic_norm:{
      room_type : '',
      floor_type : '',
      comment : '',
      frequency : 0,
      maxFrequency : [],
      elem_frequency : 0,
      factor : 0,
      tasks_table:[],
      elements_table:[],
      sq_m_area_hour: 0,
      standard_frequency: 0,
      standard_sq_m_area_hour: 0,
    },
    space_State:{
      amount:'',
      norm:'',
      frequency:'',
      rate:'',
      areaEstimateIndex:'',
      total_sq_meter_area_perHour:0.0,
      total_hours_year:0.0,
      total_hours_day:0.0,
      meter_Square_area:'',
      prd_hr_mon_fri_total_price:0.0,
      drt_supr_hr_mon_fri_total_price:0.0,
    },
    space_State_final:{
      rate:0,
      cost_rate:0,
      total_sq_meter_area_perHour:0.0,
      total_hours_year:0.0,
      total_hours_day:0.0,
      contract_sum_year:0,
      total_cost_year:0,
      total_rate_structure:0,
    },
    space_state_entry:{
      sq_meter : '',
      norm : '',
      hours_per_turn : '',
      frequency : '',
      hours_a_year : '',
      rate : '',
      amount : '',
    },
    meter_Square_area_watch:'',
  },

  mounted: function() {
    this.selectedLanguage = this.$refs.language.value;
    var self = this;
    $('#startDate').datepicker({
      dateFormat: 'dd MM yy',
      onSelect:function(selectedDate, datePicker) {
        self.start_date = selectedDate;

        if (self.end_date) {
          var endDate = new Date(self.end_date).toISOString().slice(0,10);
          var startDate = new Date(selectedDate).toISOString().slice(0,10);
          var d1 = new Date(startDate);
          var d2 = new Date(endDate);
          if(d1 > d2){
            self.start_date='',
                self.$swal("Invalid Date!", (this.selectedLanguage == 'en')?"Start date must be smaller than end date":"Begin datum moet kleiner zijn dan eind datum", "error");
          }
        }
      }
    });
    $('#endDate').datepicker({
      dateFormat: 'dd MM yy',
      onSelect:function(selectedDate, datePicker) {
        self.end_date = selectedDate;

        if (self.start_date) {
          var endDate = new Date(selectedDate).toISOString().slice(0,10);
          var startDate = new Date(self.start_date).toISOString().slice(0,10);
          var d1 = new Date(startDate);
          var d2 = new Date(endDate);
          if(d1 > d2){
            self.end_date='';
            self.$swal("Invalid Date!", (this.selectedLanguage == 'en')?"End date must be greater than start date":"Eind datum moet groter zijn dan start datum", "error");
          }
        }
      }
    });
  },

  created(){
    axios.get(APP_URL + `customersList`).then(response=>{
      this.customers = response.data.customers;
      // this.customersData = response.data.customersData;
      this.workerGroups = response.data.worker_groups;
      this.floor_types = response.data.floor_types;
      // this.room_types = response.data.room_types;
      this.elements = response.data.elements;
      this.tasks = response.data.tasks;
      console.log('hamza:',this.tasks);

      //filter to get work group out
      let value = this.workerGroups.filter(function(item){
        if (item.name == 'Medewerker Alg. GROEP 1') {
          return item;
        }
      });
      let index = this.workerGroups.findIndex(x => x.name ==  'Employer General Cleaning Group 1');
      this.workerGroups.splice(index,1);
      let entry = {
        group_name:value[0].name,
        group_detail:value[0],
        hourly_rate:value[0].total_end_wage_normale_workhours_06_to_21,
        percentage:'100',
        gross_wage:value[0].total_wage_costs_per_hour,
        number_of_hours_year:'',
        price_a_year:'',
        cost_a_year:'',
        reward:'',
      };
      this.prd_hr_mon_fri_Table.push(entry);
    }).catch(error=>{
      console.log(error.data);
    });
  }, //created ends here

/////////////////////WATCH functions strats from here////////////////////
  watch:{
    meter_Square_area_watch(newValue, oldValue){
      this.computation = true;
      _.debounce(function(newValue){
        this.space_State.meter_Square_area = newValue
      },5000)
    }
  }, //watch ends here
/////////////////////WATCH functions ends here///////////////////////////

///////////////////Comouted properties starting from here///////////////
  computed:{
    calculateNormComp(){
      if(this.basic_norm.factor == 0){
        this.basic_norm.sq_m_area_hour = 0;
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please select factor":"Selecteer een factor";
      }
      else if(this.basic_norm.factor < 0){
        this.basic_norm.sq_m_area_hour = 0;
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please Select Positive Factor":"Selecteer een positieve factor";
      }
      else if((this.basic_norm.factor != 0) && (this.basic_norm.maxFrequency != 0) && (this.basic_norm.floor_type) && (this.basic_norm.room_type))
      {
        // let total_frequency = this.basic_norm.frequency;
        let total_frequency = this.basic_norm.maxFrequency;
        let floor_type = this.basic_norm.floor_type.name;
        let room_type = this.basic_norm.room_type.name;
        let floor_type_id = this.basic_norm.floor_type.id;
        let room_type_id = this.basic_norm.room_type.id;
        let comments = 'Null';
        if (!this.basic_norm.comment) { //in case of null
          comments = 'Geen opmerkingen';
        }else {
          comments = this.basic_norm.comment;
        }
        let factor = this.basic_norm.factor;
        let standCalcultaion = this.standardCalcultaion;

        //////Get correction standard function logic strts here ///////////
        let correctionStand = 0;
        axios.post(APP_URL + `correctionStand`,{
          'floor_type' : floor_type,
          'room_type' : room_type,
          'floor_type_id' : floor_type_id,
          'room_type_id' : room_type_id,
          'comments' : comments,
          'frequency' : total_frequency,
          'standardCalcultaion' : standCalcultaion,
        })
            .then(response => {
              let floor_type_Stnd_value = response.data.standard_freq_area.standard_meter_sq_hours;

              let stnd_factor = Math.round(factor * floor_type_Stnd_value * 1);
              let sq_per_hour = 0;
              let answer = 0;
              if(response.data.stndard_percent){
                // when it is not case for standard calculation
                correctionStand = response.data.stndard_percent.factor_percent;
                sq_per_hour = (stnd_factor * 100) / parseInt(correctionStand);
                answer = Math.round(sq_per_hour);
              }else {
                // when it is case for standard calculation
                sq_per_hour = stnd_factor;
                answer = Math.round(sq_per_hour);
              }

              this.basic_norm.sq_m_area_hour = answer;
              this.basic_norm.standard_frequency = response.data.standard_freq_area.standard_frequency;
              this.basic_norm.standard_sq_m_area_hour = response.data.standard_freq_area.standard_meter_sq_hours;
              // this.addButton = false;
            })
            .catch(error => {
              this.basic_norm.factor = 0;
              this.basic_norm.sq_m_area_hour = 0;
              this.addButton = true;
              this.addNormError = (this.selectedLanguage == 'en')?"Please select factor":"Selecteer een factor";
              this.$swal("Sorry!", (this.selectedLanguage == 'en')?"No correction standard available for such frequency":"Geen correctiestandaard beschikbaar voor dergelijke frequentie", "error");
            })

        if (!this.basic_norm.room_type || this.basic_norm.elements_table.length == 0) {
          this.addButton = true;
          this.addNormError = (this.selectedLanguage == 'en')?"Please Select Room Type and Elements, something missing":"Selecteer kamertype en elementen, er ontbreekt iets";
        }else{
          this.addNormError = "";
          this.addButton = false;
        }
        //////Get correction standard function logic ends here ///////////
      }// if factor != 0
      else if(this.basic_norm.maxFrequency === 0) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select tasks and days to set frequency, to calculate square meter area":"Selecteer taken en dagen om de frequentie in te stellen en het vierkante meteroppervlak te berekenen", "error");
        this.basic_norm.factor = 0;
        this.basic_norm.sq_m_area_hour = 0;
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please select factor":"Selecteer een factor";
      }
      else if (! this.basic_norm.floor_type) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select floor type, to calculate square meter area":"Selecteer vloertype om het vierkante meteroppervlak te berekenen", "error");
        this.basic_norm.factor = 0;
        this.basic_norm.sq_m_area_hour = 0;
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please select floor type":"Selecteer vloertype";
      }

      else if (!this.basic_norm.room_type && this.basic_norm.elements_table.length == 0) {
        this.addNormError = (this.selectedLanguage == 'en')?"Please select room type and elements":"Selecteer kamertype en elementen";
        this.addButton = true;
      }
      else if(!this.basic_norm.room_type){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select room type, to calculate square meter area":"Selecteer het kamertype om het vierkante meteroppervlak te berekenen", "error");
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please select room type":"Selecteer het kamertype";
      }
      else if (this.basic_norm.elements_table.length == 0) {
        this.addButton = true;
        this.addNormError = (this.selectedLanguage == 'en')?"Please select element":"Selecteer elementen";
      }else {
        this.addNormError = "";
        this.addButton = false;
      }
      this.standardCalcultaion = false;
      return this.basic_norm.sq_m_area_hour;
    },// calNorm ends here

    total_sq_meter_area_comp(){
      if(this.space_State.meter_Square_area){
        this.space_State.rate = 0;
        this.space_State.total_sq_meter_area_perHour = 0;
        this.space_State.total_hours_year = 0;
        this.space_State.total_hours_day = 0;
        let total_sq_meter_area = parseFloat(this.space_State.meter_Square_area) + parseFloat(this.space_State_final.total_sq_meter_area_perHour);

        this.space_State.total_sq_meter_area_perHour = total_sq_meter_area;

        let hour_per_turn = 0;
        hour_per_turn = (parseFloat(this.space_State.meter_Square_area) / parseFloat(this.space_State.norm)).toFixed(2);
        this.space_state_entry.hours_per_turn = hour_per_turn;

        let hour_a_year = 0;
        hour_a_year = (parseFloat(this.space_State.frequency) * parseFloat(hour_per_turn)).toFixed(2);
        this.space_state_entry.hours_a_year = hour_a_year;
        this.space_State.total_hours_year =parseFloat(hour_a_year) + parseFloat(this.space_State_final.total_hours_year);// sum of sq meter area and fill in total sq m area
        return total_sq_meter_area;
      }
    }, //total_sq_meter_area_perHour_comp ends here

    rate_comp(){
      //As total hours a year changes, this function will do team consctruction part calculation
      if (this.computation) {
        let rate = 0;
        let prd_hr_cal = {
          'percentage' : '',
          'number_of_hours_year' : '',
          'rate' : '',
          'price_a_year' : 0.0,
          'number_of_days' : 255,
          'number_of_hours_a_day' : '',
          'total_hours_a_year' : this.space_State.total_hours_year,
        };
        let total_price_a_year_prd = 0.0;
        let prd_hr_mon_fri_cal_array = [];

        let prd_total_hr = 0;
        let prd_total_price = 0;
        let prd_total_cost = 0;

        this.prd_hr_mon_fri_Table.forEach(function(item)
        {
          let hr_numbers = ((item.percentage / 100) * prd_hr_cal.total_hours_a_year).toFixed(2);

          prd_hr_cal.percentage = item.percentage;
          prd_hr_cal.number_of_hours_year = hr_numbers;

          let hr_number_day = (hr_numbers / prd_hr_cal.number_of_days).toFixed(2);

          prd_hr_cal.number_of_hours_a_day = hr_number_day;
          prd_hr_cal.rate = item.hourly_rate;

          let price = (prd_hr_cal.rate * prd_hr_cal.number_of_hours_year).toFixed(2);

          prd_hr_cal.price_a_year = price;

          total_price_a_year_prd =  (parseFloat(total_price_a_year_prd) + parseFloat(price));
          prd_hr_mon_fri_cal_array.push(prd_hr_cal);
          let cost = (parseFloat(item.gross_wage) * parseFloat(hr_numbers)).toFixed(2);
          let reward = ((parseFloat(item.gross_wage) / parseFloat(item.hourly_rate))*100).toFixed(2);
          item.number_of_hours_year= hr_numbers;
          item.price_a_year= price;
          item.cost_a_year= cost;
          item.reward= reward;
          prd_total_hr = (parseFloat(hr_numbers) + parseFloat(prd_total_hr)).toFixed(2);
          prd_total_price = (parseFloat(prd_total_price) + parseFloat(price)).toFixed(2);
          prd_total_cost = (parseFloat(prd_total_cost) + parseFloat(cost)).toFixed(2);
        });//for prd_hr_mon_fri_Table calculation

        let hourly_Structure = (prd_total_cost / prd_total_hr).toFixed(2);
        this.prd_hr_mon_fri_total_hour = prd_total_hr;
        this.prd_hr_mon_fri_Total_price = prd_total_price;
        this.prd_hr_mon_fri_Total_cost = prd_total_cost;
        this.prd_hr_mon_fri_Total_hourly_structure = hourly_Structure;
        this.prd_hr_mon_fri_rate = (parseFloat(total_price_a_year_prd) / parseFloat(this.space_State.total_hours_year)).toFixed(2);
        let total_hours_a_space = (parseFloat(total_price_a_year_prd) / parseFloat(this.space_State.total_hours_year)).toFixed(2);

        ///////// Direct supervisor Mon fri Calculation starts from here ////////

        let drt_sup_hr_cal = {
          'percentage' : '',
          'number_of_hours_year' : '',
          'rate' : '',
          'price_a_year' : 0.0,
          'number_of_days' : 255,
          'number_of_hours_a_day' : '',
          'total_hours_a_year' : this.space_State.total_hours_year,
        };
        let total_price_a_year_drt_sup = 0.0;
        let total_number_of_hours_year = 0.0;
        let drt_total_hr = 0;
        let drt_total_price = 0;
        let drt_total_cost = 0;

        this.drt_sup_hr_mon_fri_Table.forEach(function(item)
        {
          let hr_numbers = ((item.percentage / 100) * drt_sup_hr_cal.total_hours_a_year).toFixed(2);
          drt_sup_hr_cal.percentage = item.percentage;
          drt_sup_hr_cal.number_of_hours_year = hr_numbers;
          total_number_of_hours_year = parseFloat(total_number_of_hours_year) + hr_numbers;
          let hr_number_day = (hr_numbers / drt_sup_hr_cal.number_of_days).toFixed(2);
          drt_sup_hr_cal.number_of_hours_a_day = hr_number_day;
          drt_sup_hr_cal.rate = item.hourly_rate;
          let price = (drt_sup_hr_cal.rate * drt_sup_hr_cal.number_of_hours_year).toFixed(2);
          drt_sup_hr_cal.price_a_year = price;
          total_price_a_year_drt_sup =  (parseFloat(total_price_a_year_drt_sup) + parseFloat(price));
          let cost = (parseFloat(item.gross_wage) * parseFloat(hr_numbers)).toFixed(2);
          let reward = ((parseFloat(item.gross_wage) / parseFloat(item.hourly_rate))*100).toFixed(2);
          item.number_of_hours_year= hr_numbers;
          item.price_a_year= price;
          item.cost_a_year= cost;
          item.reward= reward;
          drt_total_hr = (parseFloat(hr_numbers) + parseFloat(drt_total_hr)).toFixed(2);
          drt_total_price = (parseFloat(drt_total_price) + parseFloat(price)).toFixed(2);
          drt_total_cost = (parseFloat(drt_total_cost) + parseFloat(cost)).toFixed(2);
        });//for prd_hr_mon_fri_Table calculation
        let drt_hourly_Structure = (drt_total_cost / prd_total_hr).toFixed(2);
        this.drt_sup_hr_mon_fri_total_hour = drt_total_hr;
        this.drt_sup_hr_mon_fri_Total_price = drt_total_price;
        this.drt_sup_hr_mon_fri_Total_cost = drt_total_cost;
        this.drt_sup_hr_mon_fri_Total_hourly_structure = drt_hourly_Structure;
        // total hours a space = G14/E14 (team construction sheet)
        this.drt_sup_hr_mon_fri_rate = (parseFloat(total_price_a_year_drt_sup) / parseFloat(drt_total_hr)).toFixed(2);
        let total_hours_a_space_drt = (parseFloat(total_price_a_year_drt_sup) / parseFloat(total_number_of_hours_year)).toFixed(2);
        this.space_State_final.total_cost_year =(parseFloat(drt_total_cost) + parseFloat(prd_total_cost)).toFixed(2);
        this.space_State_final.cost_rate = (parseFloat(this.space_State_final.total_cost_year) / parseFloat(this.space_State.total_hours_year)).toFixed(2);
        this.space_State_final.total_rate_structure =(parseFloat(this.prd_hr_mon_fri_Total_hourly_structure) + parseFloat(this.drt_sup_hr_mon_fri_Total_hourly_structure)).toFixed(2);
        ///////// Direct supervisor Mon fri Calculation ends from here //////////

        rate = ((parseFloat(total_price_a_year_prd) + parseFloat(total_price_a_year_drt_sup)) / parseFloat(this.space_State.total_hours_year)).toFixed(2);

        let amount = (parseFloat(rate) * parseFloat(this.space_state_entry.hours_a_year)).toFixed(2);

        this.space_State.amount = amount;
        this.space_State.rate = rate;

///////////////////// filling space_State_entry object/////////////////////
        this.space_state_entry.sq_meter = this.space_State.meter_Square_area;
        this.space_state_entry.norm = this.space_State.norm;
        this.space_state_entry.frequency = this.space_State.frequency;
        this.space_state_entry.rate = this.space_State.rate;
        this.space_state_entry.amount = this.space_State.amount;
        return rate;
      }// if computation ends here
    }, //rate_comp ends here
  },
  //////////////////Comouted properties ends here///////////////////////

  methods:{
    onUpdate(payload){
      this.phoneDetails = payload;
    },
    clientTypeChanged(){
      this.client_name = '';
      this.address = '';
      this.email = '';
      this.phone = '';
      this.contact_person1 = '';
      this.contact_person2 = '';
    },// clientTypeChanged ends here

    clientChanged(){
      this.address = this.client_name.address;
      this.email = this.client_name.email;
      this.phone = this.client_name.phone;
      this.contact_person1 = this.client_name.contact_person1;
      this.contact_person2 = this.client_name.contact_person2;
      // this.client_name = this.client_name.name;
    },//clientChanged ends here
/////////////////////Space State Calculation starts here ///////////////
    debounceMeterArea:_.debounce(function(e){
      this.space_State.meter_Square_area = e.target.value;
      this.computation = true;
      if(e.target.value == 0){
        this.calculateButton = true;
        this.addSpaceStError = (this.selectedLanguage == 'en')?"Please add square meter area":"Voeg een vierkante meter toe";
      }else if(e.target.value < 0){
        this.calculateButton = true;
        this.addSpaceStError = (this.selectedLanguage == 'en')?"Please add positive square meter area":"Voeg een positieve vierkante meter toe";
      }else {
        this.calculateButton = false;
        this.addSpaceStError = '';
      }
    },1000),// debounceMeterArea ends here

    deleteSpaceStateRow(index){
      let row = this.space_State_Table[index];
      this.space_State_final.contract_sum_year = (parseFloat(this.space_State_final.contract_sum_year) - parseFloat(row.amount)).toFixed(2);
      this.space_State_final.total_sq_meter_area_perHour = (parseFloat(this.space_State_final.total_sq_meter_area_perHour) - parseFloat(row.sq_meter)).toFixed(2);
      this.space_State_final.total_hours_year = (parseFloat(this.space_State_final.total_hours_year) - parseFloat(row.hours_a_year)).toFixed(2);
      this.space_State_final.total_hours_day = (parseFloat(this.space_State_final.total_hours_year) / 255).toFixed(2);
      this.space_State_Table.splice(index,1);
    }, //deleteSpaceStateRow ends here

    calculateSpaceState(index){
      let entry = this.basciNormTable[index];
      this.space_State.norm = entry.sq_m_area_hour;
      this.space_State.frequency = entry.frequency;
      this.space_State.areaEstimateIndex = index;
    },// calculateSpaceState ends here

    updateSpaceStateTable(){
      let rate = this.space_State.rate;
      let new_amount = 0;
      this.space_State_Table.forEach(function(item){
        item.rate = rate;
        item.amount = (rate * item.hours_a_year).toFixed(2);
        new_amount = (parseFloat(new_amount) + parseFloat(item.amount)).toFixed(2);
      });
      this.space_State_final.contract_sum_year = new_amount;
    }, //updateSpaceStateTable ends here

    calculateAmount(){
      this.computation = false;
      if(this.space_State_final.rate != this.space_state_entry.rate && this.space_State_Table.length > 0){
        this.updateSpaceStateTable();
      } //rate changed
      this.space_State_final.rate = this.space_state_entry.rate;

      this.space_State_final.contract_sum_year = parseFloat(this.space_State_final.contract_sum_year) + parseFloat(this.space_state_entry.amount);
      this.space_State_final.total_sq_meter_area_perHour = parseFloat(this.space_State_final.total_sq_meter_area_perHour) + parseFloat(this.space_State.meter_Square_area);
      this.space_State_final.total_hours_year = parseFloat(this.space_State.total_hours_year);
      this.space_State_final.total_hours_day = (parseFloat(this.space_State_final.total_hours_year) / 255).toFixed(2);
      /////////fill space_State_Table ////////////////////
      let temp = {
        sq_meter : this.space_state_entry.sq_meter,
        norm : this.space_state_entry.norm,
        hours_per_turn : this.space_state_entry.hours_per_turn,
        frequency : this.space_state_entry.frequency,
        hours_a_year : this.space_state_entry.hours_a_year,
        rate : this.space_state_entry.rate,
        amount : this.space_state_entry.amount,
        areaEstimateIndex : this.space_State.areaEstimateIndex,
      };
      this.space_State_Table.push(temp);
      this.space_State.meter_Square_area = 0;
      this.calculateButton = true;
      this.addSpaceStError = (this.selectedLanguage == 'en')?"Please add square meter area":"Voeg een vierkante meter toe";
    }, //calculateAmount ends here

    addDirectGroup(){
      if (this.drt_sup_worker_group.group === '' && this.drt_sup_worker_group.percentage == '') {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select worker group and percentage":"Selecteer werkgroep en percentage", "error");
      }else if (this.drt_sup_worker_group.group === ''){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select worker group":"Selecteer werkgroep", "error");
      } else if (this.drt_sup_worker_group.percentage == '') {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select percentage":"Selecteer percentage", "error");
      }else if (this.drt_sup_worker_group.percentage < 0) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select positive percentage":"Selecteer een positief percentage", "error");
      }else {
        let entry = {
          group_name:this.drt_sup_worker_group.group.name,
          group_detail:this.drt_sup_worker_group.group,
          hourly_rate:this.drt_sup_worker_group.hourly_rate,
          percentage:this.drt_sup_worker_group.percentage,
          gross_wage:this.drt_sup_worker_group.group.total_wage_costs_per_hour,
          number_of_hours_year:'',
          price_a_year:'',
          cost_a_year:'',
          reward:'',
        };
        this.drt_sup_hr_mon_fri_Table.push(entry);
        let index = this.workerGroups.indexOf(this.drt_sup_worker_group.group);
        this.workerGroups.splice(index,1);
        this.drt_sup_worker_group.group = '';
        this.drt_sup_worker_group.hourly_rate = '';
        this.drt_sup_worker_group.percentage = '';
      }
    }, //addDirectGroup ends here

    groupDirectChange(){
      this.drt_sup_worker_group.hourly_rate = this.drt_sup_worker_group.group.total_end_wage_normale_workhours_06_to_21;
    }, // groupChange ends here

    deldrthrGroup(entry,id){
      this.workerGroups.push(entry);
      this.drt_sup_hr_mon_fri_Table.splice(id,1);
    },//delprdhrGroup ends here

    addGroup(){
      if (this.worker_group.group === '' && this.worker_group.percentage == '') {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select worker group and percentage":"Selecteer werkgroep en percentage", "error");
      }else if (this.worker_group.group === ''){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select worker group":"Selecteer werkgroep", "error");
      } else if (this.worker_group.percentage == '') {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select percentage":"Selecteer percentage", "error");
      }else if (this.worker_group.percentage < 0) {
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select positive percentage":"Selecteer een positief percentage", "error");
      }else {
        let entry = {
          group_name:this.worker_group.group.name,
          group_detail:this.worker_group.group,
          hourly_rate:this.worker_group.hourly_rate,
          percentage:this.worker_group.percentage,
          gross_wage:this.worker_group.group.total_wage_costs_per_hour,
          number_of_hours_year:'',
          price_a_year:'',
          cost_a_year:'',
          reward:'',
        };
        this.prd_hr_mon_fri_Table.push(entry);
        //this chunk is changing the percentage of fixed group
        this.prd_hr_mon_fri_Table[0].percentage = (parseFloat(this.prd_hr_mon_fri_Table[0].percentage) - parseFloat(this.worker_group.percentage)).toFixed(2);
        //this chunk is changing the percentage of fixed group
        let index = this.workerGroups.indexOf(this.worker_group.group);
        this.workerGroups.splice(index,1);
        this.worker_group.group = '';
        this.worker_group.hourly_rate = '';
        this.worker_group.percentage = '';
      }
    }, //addGroup

    groupChange(){
      this.worker_group.hourly_rate = this.worker_group.group.total_end_wage_normale_workhours_06_to_21;
    }, // groupChange ends here

    delprdhrGroup(entry,id,percentage){
      //this chunk is changing the percentage of fixed group
      this.prd_hr_mon_fri_Table[0].percentage = (parseFloat(this.prd_hr_mon_fri_Table[0].percentage) + parseFloat(percentage)).toFixed(2);
      //this chunk is changing the percentage of fixed group
      this.workerGroups.push(entry);
      this.prd_hr_mon_fri_Table.splice(id,1);
    },//delprdhrGroup ends here

    closeSpaceStateModal(){
      this.space_State.amount = 0;
      // this.space_State.meter_Square_area = 0;
    }, //closeSpaceStateModal ends here

////////////////////////Space State Calculation ends here ///////////////
    closeModal(){
      this.basic_norm.room_type='';
      this.basic_norm.floor_type='';
      this.basic_norm.frequency=0;
      this.basic_norm.elem_frequency=0;
      this.basic_norm.factor=0;
      this.basic_norm.tasks_table=[];
      this.basic_norm.elements_table=[];
      this.basic_norm.sq_m_area_hour=0;
      // this.basic_norm = '';
      this.task_check_status_mon = false;
      this.task_check_status_tue = false;
      this.task_check_status_wed = false;
      this.task_check_status_thu = false;
      this.task_check_status_fri = false;
      this.task_check_status_sat = false;
      this.task_check_status_sun = false;

      this.element_check_status_mon = false;
      this.element_check_status_tue = false;
      this.element_check_status_wed = false;
      this.element_check_status_thu = false;
      this.element_check_status_fri = false;
      this.element_check_status_sat = false;
      this.element_check_status_sun = false;

      this.element_days_count=0;
      this.task_days_count=0;
      this.total_task_freq=0;
      this.addButton= true;

      axios.get(APP_URL + `customersList`).then(response=>{
        this.customers = response.data.customers;
        this.floor_types = response.data.floor_types;
        this.room_types = response.data.room_types;
        this.elements = response.data.elements;
        this.tasks = response.data.tasks;
      }).catch(error=>{
        console.log(error.data);
      });
    },//closeModal ends here

    floorTypeChanged(){
      let floorId = this.basic_norm.floor_type.id;
      axios.get(APP_URL + `selectedRoomTypes/`+floorId)
          .then(response=>{
            this.room_types = response.data.roomTypes;
            this.basic_norm.room_type = null;
          })
          .catch(error=>{
            console.log(error.data);
          })
    },//floorTypeChanged ends here

    roomTypeChanged(){
      let roomId = this.basic_norm.room_type.id;
      axios.get(APP_URL + `commentsList/`+roomId)
          .then(response=>{
            this.comments = response.data.comments;
            this.basic_norm.comment = response.data.comments[0].comments;
          })
          .catch(error=>{
            console.log(error.data);
          })
    },//roomTypeChanged ends here

    deleteNormRow(index){
      swal({
        title: (this.selectedLanguage == 'en')?"Are you sure?":"Weet je dat zeker?",
        text: (this.selectedLanguage == 'en')?"Area estimate and all linked space state rows to this area estimate will be deleted":"Gebiedsschatting en alle rijen met gekoppelde ruimtestaten voor deze gebiedsschatting worden verwijderd",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
          .then((willDelete) => {
            if (willDelete) {
              let ths = this;
              this.space_State_Table.forEach(function(item,ind) {
                if(item.areaEstimateIndex === index){
                  ths.deleteSpaceStateRow(ind);
                }
              });
              this.basciNormTable.splice(index,1);
              swal((this.selectedLanguage == 'en')?"Area estimate row and linked space state rows deleted":"Gebied schatting rij en gekoppelde space state rijen verwijderd", {
                icon: "success",
              });
            }//if
          });

    }, //deleteNormRow ends here

    clearModalBefore(){
      this.basic_norm.comment='';
    },// clearModalBefore ends here

    addNorm(){
      let entry = {
        room_type : this.basic_norm.room_type,
        floor_type : this.basic_norm.floor_type,
        frequency : this.basic_norm.maxFrequency,
        elem_frequency : this.basic_norm.elem_frequency,
        factor : this.basic_norm.factor,
        tasks_table:this.basic_norm.tasks_table,
        elements_table:this.basic_norm.elements_table,
        sq_m_area_hour: this.basic_norm.sq_m_area_hour,
        comment: this.basic_norm.comment,
        //
      }
      this.basciNormTable.push(entry);
      this.basic_norm.comment = false;
      this.comments = [];
      this.closeModal();
    },// addNorm ends here

    createProject(){
      if (this.phoneDetails && !this.phoneDetails.isValid){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please add valid phone number":"Voeg een geldig telefoonnummer toe", "error");
        return null;
      }
      axios.post(APP_URL+`projectcostestimate`,{
        project_name: this.project_name,
        client_name: (this.client_name.name) ? this.client_name.name : this.client_name,
        phone: this.phoneDetails?this.phoneDetails.formattedNumber:this.phone,
        address: this.address,
        email: this.email,
        contact_person1: this.contact_person1,
        contact_person2: this.contact_person2,
        start_date: this.start_date,
        end_date: this.end_date,
        rate: this.space_State_final.rate,
        total_sq_meter_per_hour: this.space_State_final.total_sq_meter_area_perHour,
        total_hours_a_year: this.space_State_final.total_hours_year,
        total_hours_a_day: this.space_State_final.total_hours_day,
        contract_sum_a_year: this.space_State_final.contract_sum_year,
        normTable:this.basciNormTable,
        spaceStateTable:this.space_State_Table,
        prd_hr_mon_fri_Table:this.prd_hr_mon_fri_Table,
        drt_sup_hr_mon_fri_Table:this.drt_sup_hr_mon_fri_Table,
      })
          .then(response=>{
            this.$swal("Good job!", (this.selectedLanguage == 'en')?"New cost estimate created":"Nieuwe kostenraming gemaakt", "success");
            let indexUrl = this.$refs.url.value;
            setTimeout(function(){
              window.location = indexUrl;
            }, 2000);
          })
          .catch(error=>{
            this.errors = error.response.data.errors;
            console.error(error.response.data.errors);
            this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please fill required fields":"Vul de verplichte velden in", "error");
            // this.$swal('Please fill required fields');
          });
    } ,//createProject ends here

    task_freq(event){
      if(event.target.checked){
        this.task_days_count= this.task_days_count + 1;
      }
      else{
        this.task_days_count= this.task_days_count - 1;
      }
      // this.calculateNorm();
    }, //Task_freq ends here

    deleteTask(task,task_id){
      let deletedItem = this.basic_norm.tasks_table.splice(task_id,1);
      this.tasks.push(task);
      let maxFrequency=[];
      let z=0;
      for (let i = 0; i <  this.basic_norm.tasks_table.length; i++) {
        maxFrequency[z]=this.basic_norm.tasks_table[i].task_frequency;
        z++;
      }

      this.basic_norm.maxFrequency=myArrayMax(maxFrequency);
      function myArrayMax(arr) {
        return Math.max.apply(null, arr);
      }
      // this.basic_norm.frequency = parseInt(this.basic_norm.frequency)  - parseInt(deletedItem[0].task_frequency);
    }, // deleteTask ends here

    addTask(){
      if(this.task_entry.task && this.task_days_count > 0 && this.task_days_count < 5)
      {
        let t_entry = {
          'task_name' : this.task_entry.task.name,
          'task_frequency' : this.task_days_count * 52,
          'task_object': this.task_entry.task,
        };
        this.selectedTasks.push(this.task_entry.task);
        let index = this.tasks.indexOf(this.task_entry.task);
        this.tasks.splice(index,1);

        this.basic_norm.tasks_table.push(t_entry);
        let maxFrequency=[];
        let z=0;

        for (var i = 0; i <  this.basic_norm.tasks_table.length; i++) {
          maxFrequency[z]=this.basic_norm.tasks_table[i].task_frequency;
          z++;
        }
        this.basic_norm.maxFrequency=myArrayMax(maxFrequency);
        function myArrayMax(arr) {
          return Math.max.apply(null, arr);
        }

        // this.basic_norm.frequency = parseInt(this.basic_norm.frequency)  + (parseInt(this.task_days_count) * 52);

        this.task_days_count = 0;
        this.task_entry.task = '';
        this.task_check_status_mon = false;
        this.task_check_status_tue = false;
        this.task_check_status_wed = false;
        this.task_check_status_thu = false;
        this.task_check_status_fri = false;
        this.task_check_status_sat = false;
        this.task_check_status_sun = false;

        // this.calculateNorm(); //this is to calculte norm
      }// if tasks and task days are selected
      else if(this.task_entry.task && this.task_days_count === 5){
        let t_entry = {
          'task_name' : this.task_entry.task.name,
          'task_frequency' : (((this.task_days_count * 52)-5)* this.shiftType),
          'task_object': this.task_entry.task,
        };
        this.selectedTasks.push(this.task_entry.task);
        let index = this.tasks.indexOf(this.task_entry.task);
        this.tasks.splice(index,1);
        // console.log(t_entry);
        this.basic_norm.tasks_table.push(t_entry);
        console.log(this.basic_norm.tasks_table);
        let maxFrequency=[];
        let z=0;
        for (let i = 0; i <  this.basic_norm.tasks_table.length; i++) {
          maxFrequency[z]=this.basic_norm.tasks_table[i].task_frequency;
          z++;
        }

        this.basic_norm.maxFrequency=myArrayMax(maxFrequency);
        function myArrayMax(arr) {
          return Math.max.apply(null, arr);
        }
        // this.basic_norm.frequency = parseInt(this.basic_norm.frequency)  + parseInt((((this.task_days_count * 52)-5)* this.shiftType));

        this.standardCalcultaion =true;
        this.task_days_count = 0;
        this.task_entry.task = '';
        this.task_check_status_mon = false;
        this.task_check_status_tue = false;
        this.task_check_status_wed = false;
        this.task_check_status_thu = false;
        this.task_check_status_fri = false;
        this.task_check_status_sat = false;
        this.task_check_status_sun = false;
        this.shiftType = 1;
      }// if tasks not selected
      else if(! this.task_entry.task && ! this.task_days_count > 0){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select task and days":"Selecteer taak en dagen", "error");
      }// if tasks not selected
      else if(! this.task_days_count > 0){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select days":"Selecteer dagen", "error");
      }// if task days not selected
      else if(! this.task_entry.task){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select task":"Selecteer taak", "error");
      }// if nothing selected
      else if(this.task_days_count > 5){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Selected days must be a maximum of 5":"Geselecteerde dagen mogen maximaal 5 zijn", "error");
        this.task_check_status_mon = false;
        this.task_check_status_tue = false;
        this.task_check_status_wed = false;
        this.task_check_status_thu = false;
        this.task_check_status_fri = false;
        this.task_check_status_sat = false;
        this.task_check_status_sun = false;
        this.task_days_count = 0;
      }// if nothing selected
    }, //addTask ends here

    /////////////////////Elements Methods starting from here/////////////

    element_freq(event){
      if(event.target.checked){
        this.element_days_count= this.element_days_count + 1;
      }
      else{
        this.element_days_count= this.element_days_count - 1;
      }
    }, //element_freq ends here

    addElement(){

      if(this.element_entry.element && this.element_days_count > 0)
      {
        let e_entry = {
          'element_name' : this.element_entry.element.name,
          'element_frequency' : this.element_days_count * 52,
          'element_object': this.element_entry.element,
        };

        this.selectedTasks.push(this.task_entry.task);
        let index = this.elements.indexOf(this.element_entry.element);
        this.elements.splice(index,1);

        this.basic_norm.elements_table.push(e_entry);
        this.basic_norm.elem_frequency = parseInt(this.basic_norm.elem_frequency)  + parseInt(this.element_days_count * 52);
        this.element_days_count = 0;
        this.element_entry.element = '';
        this.element_check_status_mon = false;
        this.element_check_status_tue = false;
        this.element_check_status_wed = false;
        this.element_check_status_thu = false;
        this.element_check_status_fri = false;
        this.element_check_status_sat = false;
        this.element_check_status_sun = false;
      }//if element and days are selected
      else if(! this.element_entry.element && ! this.element_days_count > 0){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select element and days":"Selecteer element en dagen", "error");
      }//if elemet not selected
      else if(! this.element_days_count > 0){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select element days":"Selecteer Elementdagen", "error");
      }//if elemet days not selected
      else if(! this.element_entry.element){
        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please select element":"Selecteer element", "error");
      }//if nothing is selected
    }, //addElement ends here

    deleteElement(element,element_id){
      let deletedItem = this.basic_norm.elements_table.splice(element_id,1);
      this.elements.push(element);
      this.basic_norm.elem_frequency = parseInt(this.basic_norm.elem_frequency)  - parseInt(deletedItem[0].element_frequency);
    }, // deleteTask ends here
  }, //methods ends here
})
