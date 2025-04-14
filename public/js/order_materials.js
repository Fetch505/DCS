Vue.component('v-select', VueSelect.VueSelect);

new Vue({
    el: '#order_materials',
    data:{
        selectedLanguage : 'en',
        isAssignDisabled: false,
        selectedCategory: '',
        selectedType: '',
        selectedMaterials: [],
        materialCategories: [],
        materialTypes: [],
        materials: [],
        projects: [],
        orderMaterials: [],
        totalQuantity: 0,
        successMessage: '',
        errors: []
    },
    mounted() {
        this.materialCategories = categories;
        this.projects = projects;
        console.log("categories:", this.materialCategories);

        this.materialCategories.forEach(category => {
            // Populate materialTypes for each category
            category.material_types.forEach(materialType => {
                this.materialTypes.push(materialType);
    
                // Populate materials for each materialType
                materialType.materials.forEach(material => {
                    this.materials.push(material);
                });
            });
        });
    },
    computed: {
        getTotalQuantity() {
            this.totalQuantity = this.orderMaterials.reduce((total, material) => {
                return total + parseInt(material.orderQuantity || 0);
            }, 0);
            return this.totalQuantity;
        }
    },
    methods: {

        filterMaterialTypes() {
            console.log("selectedCategory:", this.selectedCategory);
            const selectedCategory = this.materialCategories.find(category => category.id === this.selectedCategory);
            if (selectedCategory) {
                this.materialTypes = selectedCategory.material_types;
                this.materials = selectedCategory.material_types.reduce((acc, materialType) => {
                    return acc.concat(materialType.materials);
                }, []);
            }
            console.log("materials:", this.materials);
        },

        filterMaterials() {
            console.log("selectedType:", this.selectedType);
            const selectedMaterialType = this.materialTypes.find(materialType => materialType.id === this.selectedType);
            if (selectedMaterialType) {
                this.materials = selectedMaterialType.materials;
            }
            console.log("materials:", this.materials);
        },

        addSelectedMaterials() {
            this.selectedMaterials.forEach(selectedMaterial => {
                const exists = this.orderMaterials.some(material => material.id === selectedMaterial.id);
                
                if (!exists) {
                    this.orderMaterials.push({
                        id: selectedMaterial.id,
                        name: selectedMaterial.name,
                        quantity: selectedMaterial.quantity,
                        suppliers: selectedMaterial.suppliers,
                        orderQuantity: 0  // Adding new quantity field with default value
                    });
                }
            });
            this.selectedMaterials = [];
            console.log("orderMaterials:", this.orderMaterials);

        },
        removeMaterial(index) {
            this.orderMaterials.splice(index, 1);
        },
        assignMaterials() {

            // this.isAssignDisabled = true;
            const materials = this.orderMaterials.map(material => ({
                id: material.id,
                name: material.name,
                quantity: parseInt(material.orderQuantity),
                supplier: {
                    id: material.supplier.id,
                    name: material.supplier.name,
                    email: material.supplier.email
                },
                project: material.project ? {
                    id: material.project.id,
                    name: material.project.name,
                    address: material.project.address
                } : null 
            }));
            console.log("totalQuantity:", this.totalQuantity);
            console.log("Materials:", materials);

            const formData = {
                materials: materials,
                totalQuantity: this.totalQuantity};

            axios.post(APP_URL+`/order-materials`, formData)
            .then(response => {
                this.successMessage = 'Materials Ordered Successfully';
                console.log("response:", response.data);
                setTimeout(function(){
                    window.location.href = response.data.redirectUrl;
                }, 2000);
            })
            .catch(error => {
                console.error("Error ordering materials:", error.response.data.error);
                this.errors.push(error.response.data.error);
            });
        }
    }
})