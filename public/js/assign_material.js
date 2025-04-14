Vue.component('v-select', VueSelect.VueSelect);

new Vue({
    el: '#assign_material',
    data:{
        selectedLanguage : 'en',
        isAssignDisabled: false,
        paymentProof: null,
        projectId:'',
        selectedCategory: '',
        selectedType: '',
        selectedMaterials: [],
        materialCategories: [],
        materialTypes: [],
        materials: [],
        assigingMaterials: [],
        totalQuantity: 0, // Initialize totalQuantity variable
        errors: []
    },
    mounted() {
        this.materialCategories = materialData.materialCategories;
        this.materialTypes = materialData.materialTypes;
        this.materials = materialData.materials;
        this.projectId = projectId;
        console.log("projectId:", this.projectId);
        console.log("materials:", this.materials);
    },
    computed: {
        getTotalQuantity() {
            this.totalQuantity = this.assigingMaterials.reduce((total, material) => {
                return total + parseInt(material.assignQuantity || 0);
            }, 0);
            return this.totalQuantity;
        }
    },
    methods: {
        
        handleFileUpload(event) {
            this.paymentProof = event.target.files[0];
        },

        populateTypes() {
            console.log("selectedCategory:", this.selectedCategory);
            const formData = {
                projectId: this.projectId,
                categoryId: this.selectedCategory,
            };

            axios.post(APP_URL+`project/getTypes`, formData)
                .then(response => {
                    console.log("materialTypes:", response.data);
                    this.materialTypes = response.data.materialTypes;
                    this.materials = response.data.materials;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        populateMaterials() {
            const formData = {
                projectId: this.projectId,
                typeId: this.selectedType,
            };

            axios.post(APP_URL+`project/getMaterials`, formData)
                .then(response => {
                    console.log("response:", response.data);

                    this.materials = response.data.materials;
                    // Assuming you want to clear selected materials when changing type
                    this.selectedMaterials = [];
                    // You may need to select the category corresponding to material_category_id
                    this.selectedCategory = response.data.material_category_id;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        addSelectedMaterials() {
            this.selectedMaterials.forEach(selectedMaterial => {
                // Check if the material already exists in assigingMaterials array
                const exists = this.assigingMaterials.some(material => material.id === selectedMaterial.id);
                
                // If the material doesn't already exist, add it
                if (!exists) {
                    this.assigingMaterials.push({
                        id: selectedMaterial.id,
                        name: selectedMaterial.name,
                        quantity: selectedMaterial.quantity,
                        consumable: parseInt(selectedMaterial.consumable),
                        consumption: selectedMaterial.consumable ? selectedMaterial.consumption_per_day : 0,
                        editing: false,  
                        assignQuantity: 0  // Adding new quantity field with default value
                    });
                }
            });
            this.selectedMaterials = [];
            console.log("assigingMaterials:", this.assigingMaterials);

        },
        removeMaterial(index) {
            this.assigingMaterials.splice(index, 1);
        },
        editMaterial(index) {
            this.assigingMaterials[index].editing = true;
          },
        assignMaterials() {
            const invalidMaterials = this.assigingMaterials.filter(material => {
                return material.assignQuantity < 0 || material.assignQuantity > parseInt(material.quantity);
            });
        
            this.errors = [];
            if (invalidMaterials.length > 0) {
                this.errors.push('Invalid quantities detected. Please ensure quantities are within the allowed range.');
                return;
            }

            // If there are any invalid materials, display an error message
            // if (invalidMaterials.length > 0 || !this.paymentProof) {
            //     if (invalidMaterials.length > 0) {
            //         this.errors.push('Invalid quantities detected. Please ensure quantities are within the allowed range.');
            //     }
            //     if (!this.paymentProof) {
            //         this.errors.push('Please select a file to upload.');
            //     }
            //     return;
            // }

            this.isAssignDisabled = true;
            console.log('Payment Proof:', this.paymentProof);
            console.log("totalQuantity:", this.totalQuantity);

            const materials = this.assigingMaterials.map(material => ({
                id: material.id,
                quantity: parseInt(material.assignQuantity),
                consumption: parseInt(material.consumption)
            }));
            console.log("assigingMaterials:", JSON.stringify(materials));

            // Create FormData object to send file and other data
            const formData = new FormData();
            if (this.paymentProof) {
                formData.append('paymentProof', this.paymentProof); // Append payment proof file
            }
            formData.append('materials', JSON.stringify(materials)); // Append quantities data
            formData.append('totalQuantity', this.totalQuantity); // Append totalQuantity data

            // Send POST request using Axios
            axios.post(APP_URL+`/store-materials/${this.projectId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data' // Set content type as multipart/form-data
                }
            })  .then(response => {
                    // console.log('Response', response.data);
                    window.location.href = response.data.redirectUrl;
                })
                .catch(error => {
                    // Handle error
                    console.error("Error assigning materials:", error.response.data.error);
                });
        }
    }
});