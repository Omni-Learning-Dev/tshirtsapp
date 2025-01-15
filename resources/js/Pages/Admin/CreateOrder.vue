<template>
    <v-toolbar class="mb-3 glass rounded-lg">
        <v-toolbar-title>
           Order List
        </v-toolbar-title>
    </v-toolbar>

    <v-card class="glass rounded-lg mt-5">

        <v-toolbar color="primary">
            <v-spacer/>

            <v-dialog v-model="dialog" width="700" persistent>
                <template  v-slot:activator="{ props: activatorProps }">
                    <v-btn color="white" variant="outlined" v-bind="activatorProps">
                        Add Order
                    </v-btn>
                </template>

                <v-form method="post" @submit.prevent="addOrderDetails">
                    <v-card variant="flat">
                        <v-card-title>
                            Order Details
                        </v-card-title>

                        <v-card-text>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.quantity"
                                        :error-messages="$page.props.errors.name"
                                        label="Enter Quantity"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>
                                    <v-file-input
                                        v-model="form.logo_image"
                                        label="  logo Image"
                                        prepend-icon=""
                                    />




                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.front_text"
                                        :error-messages="$page.props.errors.front_text"
                                        label="Front Color"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.back_text"
                                        :error-messages="$page.props.errors.back_text"
                                        label="  Back text"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                            </v-row>



                            <v-text-field
                                rows="3"
                                v-model="form.total_price"
                                :error-messages="$page.props.errors.total_price"
                                label="Enter Price"
                                variant="outlined"
                                density="comfortable"
                            />


                            <v-row>
                                <v-col>
                                    <v-select
                                        v-model="form.status"
                                        label="Select Status"
                                        :items="['pending','completed','canceled']"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>
                                    <v-select
                                        v-model="form.payment_status"
                                        label="Payment Status"
                                        :items="['paid','unpaid']"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>
                                    <v-select
                                        v-model="form.gender"
                                        label="Select Gender"
                                        :items="['men','women','unisex','kids']"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>
                                    <v-select
                                        v-model="form.size"
                                        label="Select Size"
                                        :items="['XS','S','M','L','XL','XXL','3XL','4XL','5XL',
                                        '2T','3T','4T','6-7','8-10','10-12','12-14']"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <v-card-actions class="glass">
                            <v-btn color="warning" @click="()=>{ this.form.reset(); this.dialog = false }">
                                Cancel
                            </v-btn>

                            <v-spacer/>

                            <v-btn :loading="form.processing" variant="flat" color="success" type="submit">
                                <span v-if="form.id > 1">Update Order Details</span>
                                <span v-else>Add Order</span>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>
        </v-toolbar>
        <v-card-text>
            <v-data-table
                :items="$page.props.orders"
                :headers="headers"
            >
                <template v-slot:item.actions="{ item }">
                    <div class="d-flex">
                        <v-btn color="primary" variant="flat" @click="showUpdateForm(item)">
                            View
                        </v-btn>

                        <v-btn class="ml-2" color="error" variant="flat" @click="deleteOrder(item)">
                            Delete
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>


export default {


    data(){
        return{
            form:this.$inertia.form({
                id:'',
                quantity:'',
                logo_image:'',
                front_text:'',
                back_text:'',
                total_price:'',
                status:'',
                payment_status:'',
                gender:'',
                size:'',

            }),

            headers:[
                {title:'id', key:'id'},
                { title: 'Order Quantity', key: 'quantity' },

                { title: 'Front text', key: 'front_text' },
                { title: 'Back text', key: 'back_text' },
                { title: 'Total price', key: 'total_price' },
                { title: 'Status', key: 'status' },
                { title: 'Payment status', key: 'payment_status' },
                { title: 'Gender', key: 'gender' },
                { title: 'Size', key: 'size' },

                { title: 'Actions', key: 'actions', sortable:false },
            ],
            search:'',
            dialog:false,



        }
    },
    mounted(){
        this.$swal.fire({})
    },

    methods:{

        addOrderDetails(){

            if(this.form.id){

                this.form.put(route('order.update',this.form.id),{
                    onSuccess:()=>{
                        this.dialog = false
                    }
                })

            }else{

                this.form.post(route('order.store'),{
                    onSuccess:()=>{
                        this.dialog = false
                    }
                })

            }
        },


        deleteOrder(order){

            this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete order!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    this.$inertia.delete(route('order.destroy',order.id),{
                        onSuccess:()=>{
                            this.dialog = false
                        }
                    })
                }
            });
        },

        showUpdateForm(order){

            //Fill Form with Values

            this.form.id                        = order.id
            this.form.quantity                  = order.name
            this.form.logo_image                = order.logo_image
            this.form.front_text                = order.front_text
            this.form.back_text                = order.back_text
            this.form.total_price               = order.total_price
            this.form.status                    = order.status
            this.form.payment_status            = order.payment_status
            this.form.gender                    = order.gender
            this.form.size                      =order.size

            //Show Dialog

            this.dialog = true
        }
    }
}
</script>
