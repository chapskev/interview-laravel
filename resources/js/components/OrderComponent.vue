<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Order </div>
                    <div class="card-body">
                        <h5 class="card-title">create new order</h5>
                        <button @click="clearForm()" class="btn btn-warning">New</button>
                        <hr />
                        <form  @submit.prevent="addOrder" class="mb-3">
                            <div class="form-group">
                                <label>Order Name: </label>
                                <input type="text" class="form-control" placeholder="Name" v-model="order.name">
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
                        <div v-for="order in orders" v-bind:key="order.order_id" class="col-md-6">
                            <div class="card ">
                                <div class="card-header">
                                    {{ order.name }}}
                                </div>
                                <div class="card-body">
                                    {{ order.name }}} {{ order.order_id}}
                                </div>
                                <div class="card-footer">
                                    <button @click="editOrder(order)" class="btn btn-info">Edit</button>
                                    <button @click="deleteOrder(order)" class="btn btn-danger">Delete</button>
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
                orders: [],
                order: {
                    order_id: '',
                    name: '',
                },
                order_id: null,
                pagination: {},
                edit: false,

            };
        },
        created() {
            this.fetchOrders();
        },
        methods: {
            fetchOrders() {
                fetch('api/orders')
                    .then(res => res.json())
                    .then(res => {
                        this.orders = res.data;
                    })
            },
            deleteOrder(order_id) {
                if (confirm("Are you sure you want to delete ?"))
                    fetch(`api/orders/${order_id}`, {
                        method: 'DELETE',
                    }).then(res => res.json())
                        .then(res => {
                            alert(`Order ${res.data.name} deleted successful`);
                            this.fetchOrders();
                        }).catch(err => {
                        console.log(err);
                        this.fetchOrders();
                    })
            },
            addOrder() {
                if (this.edit === false) {
                    // Add
                    fetch('api/orders', {
                        method: 'post',
                        body: JSON.stringify(this.order),
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(handleErrors)
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Order Added');
                            this.fetchOrders();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/orders', {
                        method: 'put',
                        body: JSON.stringify(this.order),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.clearForm();
                            alert('Order Updated');
                            this.fetchOrders();
                        })
                        .catch(err => console.log(err.toString()));
                }
            },
            editOrder(order) {
                this.edit = true;
                this.order.name = order.name;
                this.order.order_id = order.order_id;

            },
            clearForm() {
                this.edit = false;
                this.order.order_id = null;
                this.order.name = null;
            }
        },
        mounted() {
            this.fetchOrders();
        }
    }
</script>
