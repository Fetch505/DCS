new Vue({
  'el' : '#app',
  data:{
    workerTypes: [],
    quotation: {
        company_name: '',
        poc: '',
        address: '',
        phone_number:'',
        total_price: 0.00,
        rate_type: 'hourly',
    },
    items: [],
    errors: []
  },
  mounted() {
      this.quotation = data.quotation;
      this.items = data.quotation.items;
      this.workerTypes = data.workerTypes;
      console.log("quotation:", this.quotation);
      console.log("items:", this.items);
      console.log("workerTypes:", this.workerTypes);
  },
  methods: {
    addItem() {
      this.items.push({ worker_type_id: '', total_workers: 1, rate: 0.00, total_hours_per_worker: 0.00, discount: 0.00, net_rate: 0.00, price: 0.00 });
    },
    calculateItemPrice(item) {
      item.net_rate = item.rate - (item.rate * item.discount / 100);
      if (this.quotation.rate_type === 'hourly') {
        item.price = item.net_rate * item.total_hours_per_worker * item.total_workers;
      } else if (this.quotation.rate_type === 'monthly') {
        item.price = item.net_rate * item.total_workers;
      }
      return item.net_rate;
    },
    calculateTotalPrice() {
      this.quotation.total_price = this.items.reduce((total, item) => {
        return total + item.price;
      }, 0);
      return this.quotation.total_price;
    },
    submitForm() {
      axios.put(APP_URL + `quotations/${this.quotation.id}`, { quotation: this.quotation, items: this.items })
        .then(response => {
          console.log(response.data);
          window.location.href = response.data.redirectUrl;
        })
        .catch(error => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },
  }
})