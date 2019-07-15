<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Product </div>
                    <div class="card-body">
                        <h5 class="card-title">create new product</h5>
                        <button @click="clearForm()" class="btn btn-warning">New</button>
                        <hr />
                        <form  @submit.prevent="addProduct" class="mb-3">
                            <div class="form-group">
                                <label>Product Id: </label>
                                <input type="text" class="form-control" placeholder="Product ID" v-model="product.product_id">
                            </div>
                            <div class="form-group">
                                <label>Supplier Id: </label>
                                <input type="text" class="form-control" placeholder="Supplier ID" v-model="product.supplier_id">
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
                        <div v-for="product in products" v-bind:key="product.product_id" class="col-md-6">
                            <div class="card ">
                                <div class="card-header">
                                    product_id:    {{ product.product_id }}
                                </div>
                                <div class="card-body">
                                    product_id: {{ product.product_id }} <br>
                                    {{ product.supplier_id}}
                                </div>
                                <div class="card-footer">
                                    <button @click="editProduct(product)" class="btn btn-info">Edit</button>
                                    <button @click="deleteProduct(product)" class="btn btn-danger">Delete</button>
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
                products: [],
                product: {
                    product_id: '',
                    name: '',
                },
                product_id: null,
                pagination: {},
                edit: false,

            };
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                fetch('api/products')
                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;
                    })
            },
            deleteProduct(product_id) {
                if (confirm("Are you sure you want to delete ?"))
                    fetch(`api/products/${product_id}`, {
                        method: 'DELETE',
                    }).then(res => res.json())
                        .then(res => {
                            alert(`Product ${res.data.name} deleted successful`);
                            this.fetchProducts();
                        }).catch(err => {
                        console.log(err);
                        this.fetchProducts();
                    })
            },
            addProduct() {
                if (this.edit === false) {
                    // Add
                    fetch('api/products', {
                        method: 'post',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(handleErrors)
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Product Added');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/products', {
                        method: 'put',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Product Updated');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err.toString()));
                }
            },
            editProduct(product) {
                this.edit = true;
                this.product.name = product.name;
                this.product.product_id = product.product_id;

            },
            clearForm() {
                this.edit = false;
                this.product.product_id = null;
                this.product.name = null;
            }
        },
        mounted() {
            this.fetchProducts();
        }
    }
</script>
