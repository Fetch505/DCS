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
    items: [
        { worker_type_id: '', total_workers: 1,  rate: 0.00, total_hours_per_worker: 0.00, discount: 0.00, net_rate: 0.00, price: 0.00 }
    ],
    errors: []
  },
  mounted() {
      this.workerTypes = workerTypes;
      console.log("workerTypes:", this.workerTypes);
  },
  methods:{
    addItem() {
        this.items.push({ worker_type_id: '', total_workers: 1,  rate: 0.00, total_hours_per_worker: 0.00, discount: 0.00, net_rate: 0.00, price: 0.00 });
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
        console.log("quotation: ", this.quotation);
        console.log("items: ", this.items);
        axios.post(APP_URL + `quotations`, { quotation: this.quotation, items: this.items })
            .then(response => {
                // Handle success
                console.log(response.data);
                window.location.href = response.data.redirectUrl;
            })
            .catch(error => {
                this.errors = Object.values(error.response.data.errors).flat();
                console.log(this.errors);
            });
    }
}
})