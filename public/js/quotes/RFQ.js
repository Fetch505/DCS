
// import VueSwal from 'vue-swal';

Vue.use(VueSwal);
Vue.component('v-select', VueSelect.VueSelect);

new Vue({
  el: '#quotes',
  created(){
    console.log('hello');
    this.getDetails();
  },//created ends here

  mounted(){
    console.log('project id = ', this.$refs.project_id.value);
    this.project_id = this.$refs.project_id.value;
  }, //mounted ends here

  // components:{
  //   'v-select':VueSelect,
  // },

  data:{
    name: 'abid',
    project_id : '',
    material: '',
    quantity: '',
    projects : [],
    materials : [],
    items : [],
    cart : {
      project_id : '',
      material_id : '',
      quantity : '',
    },
  },

  methods:{
    getDetails(){
      console.log('mounted and getDetails called');
      axios.get(APP_URL + `materialList`).then(response=>{
        console.log(response);
        this.materials = response.data.proj_materials;
        console.log('this material list', this.materials);
      }).catch(error=>{
        console.log(error);
      })
    },//getDetails ends here

    projectChanged(){
      console.log('projcet changed');
    },//projectChanged ends here

    newRequest(){
      console.log('New request for quotes');
    },//newRequest ends here

    addToCart(){
      console.log('addToCart called');
      let order = {
        project_id : this.project_id,
        material_id : this.material.id,
        material_name : this.material.name,
        quantity : this.quantity,
      }

      //check if this material id exist in items array then append it instead of creating new row

      var valObj = this.items.filter(function(elem){
          if(elem.material_id == order.material_id) return elem;
      });

      console.log('OBJECT', valObj)

      if (valObj.length > 0) {
        let quant = parseInt(valObj[0].quantity);
        let total = quant+parseInt(this.quantity);
        valObj[0].quantity = total;
      }
      else {
        this.items.push(order);
      }

      this.quantity = '';
      this.material = '';
      console.log('items array', this.items);
    },//addToCart ends here

    placeOrder(){
      console.log('place order');
      axios.post(APP_URL+`placeOrder`,{
        project_id: this.project_id,
        items: this.items,
      })
      .then(response=>{
        console.log('response from place order : ', response);
        this.$swal('Request for Quotes Sent to Suppliers');
        this.items=[];
        // window.location.href = APP_URL + `quotesIndex`;
        })
      .catch(error=>{
        console.log(error);
      });
    }, //placeOrder ends here

  }, //Methods ends here
})//vue ends here
