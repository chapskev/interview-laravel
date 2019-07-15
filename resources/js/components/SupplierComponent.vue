<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card border-dark bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Supplier </div>
                    <div class="card-body">
                        <h5 class="card-title">create new supplier</h5>
                        <button @click="clearForm()" class="btn btn-warning">New</button>
                        <hr />
                        <form  @submit.prevent="addSupplier" class="mb-3">
                            <div class="form-group">
                                <label>Supplier Name: </label>
                                <input type="text" class="form-control" placeholder="Name" v-model="supplier.name">
                            </div>

                            <div class="form-group">
                                <label>Supplier ID: </label>
                                <input type="text" class="form-control" placeholder="Name" v-model="supplier.supplier_id">
                            </div>

                            <button type="submit" class="btn btn-light col-md-6 btn-block">Save</button>
                            <button @click="clearForm()" class="btn btn-danger  col-md-6 btn-block">Cancel</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="row justify-content-center">
                    <div class="card-group">
                        <div v-for="supplier in suppliers" v-bind:key="supplier.supplier_id" class="col-md-6">
                            <div class="card border-dark" style="background-color: #d1ecf1;">
                                <div class="card-header">
                                    {{ supplier.name }}}
                                </div>
                                <div class="card-body">
                                    {{ supplier.name }}} {{ supplier.supplier_id}}
                                </div>
                                <div class="card-footer">
                                    <button @click="editSupplier(supplier)" class="btn btn-info">Edit</button>
                                    <button @click="deleteSupplier(supplier)" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    function handleErrors(response) {
        if (!response.ok) {
            throw Error(response.statusText);
        }
        return response;
    }

    export default {
        data() {
            return { //state in vue
                suppliers: [],
                supplier: {
                    supplier_id: '',
                    name: '',
                },
                supplier_id: null,
                pagination: {},
                edit: false,

            };
        },
        created() {
            this.fetchSuppliers();
        },
        methods: {
            fetchSuppliers() {
                fetch('api/suppliers')
                    .then(res => res.json())
                    .then(res => {
                        this.suppliers = res.data;
                    })
            },
            deleteSupplier(supplier_id) {
                if (confirm("Are you sure you want to delete ?"))
                    fetch(`api/suppliers/${supplier_id}`, {
                        method: 'DELETE',
                    }).then(res => res.json())
                        .then(res => {
                            alert(`Supplier ${res.data.name} deleted successful`);
                            this.fetchSuppliers();
                        }).catch(err => {
                        console.log(err);
                        this.fetchSuppliers();
                    })
            },
            addSupplier() {
                if (this.edit === false) {
                    // Add
                    axios.post('api/suppliers', this.supplier)
                        .then(handleErrors)
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Supplier Added');
                            this.fetchSuppliers();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/suppliers', {
                        method: 'put',
                        body: JSON.stringify(this.supplier),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Supplier Updated');
                            this.fetchSuppliers();
                        })
                        .catch(err => console.log(err.toString()));
                }
            },
            editSupplier(supplier) {
                this.edit = true;
                this.supplier.name = supplier.name;
                this.supplier.supplier_id = supplier.supplier_id;
                this.supplier_id = supplier.supplier_id;

            },
            clearForm() {
                this.edit = false;
                this.supplier.supplier_id = null;
                this.supplier.name = null;
                this.supplier_id = null;
            }
        },
        mounted() {
            this.fetchSuppliers();
        }
    }
</script>
