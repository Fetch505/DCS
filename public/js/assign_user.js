Vue.component('v-select', VueSelect.VueSelect);

new Vue({
    el: '#assign_user',
    data:{
        selectedLanguage : 'en',
        isAssignDisabled: false,
        has_usage:false,
        usageLimit: 1,
        projectId:'',
        materialId:'',
        users: [],
        selectedUsers: [],
        assigingUsers: [],
        totalQuantity: 0, // Initialize totalQuantity variable
        availableQuantity: 0,
        errors: []
    },
    mounted() {
        this.users = users;
        this.projectId = projectId;
        this.materialId = MaterialId;
        this.availableQuantity = availableQuantity;
        this.has_usage = parseInt(usage);
        console.log("usage:", this.has_usage);
    },
    computed: {
        getTotalQuantity() {
            this.totalQuantity = this.selectedUsers.reduce((total, user) => {
                return total + parseInt(user.quantity || 0);
            }, 0);
            return this.totalQuantity;
        }
    },
    methods: {
        
        submitForm() {
            if (this.totalQuantity > this.availableQuantity) {
                this.errors.push("Total exceeds available quantity");
            } else {
                const formData = {
                    project_id: this.projectId,
                    material_id: this.materialId,
                    usage_limit: this.has_usage ? this.usageLimit : 0,
                    totalQuantity: this.totalQuantity,
                    users: this.selectedUsers
                };
                axios.post(APP_URL+`/project/material/user-assignments`, formData)
                .then(response => {
                    window.location.href = response.data.redirectUrl;
                })
                .catch(error => {
                    console.error("Error assigning materials:", error.response.data.error);
                });
            } 

        }
    }
});