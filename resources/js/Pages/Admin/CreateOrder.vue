<template>
    <section class="contact-hero">
        <v-container>
            <div class="text-center mb-3 mt-5">
                <h1 class="hero-h12 text-white">
                    Add  Order
                </h1>
            </div>
        </v-container>
    </section>
    <section class ="mt-n16 white glass mx-lg-5 mx-2">
        <v-card variant="flat">
            <v-card-text>
                <v-row>
                    <v-col order-md="last" cols="12" md="7">
                        <div class="glass">
                            <v-card-title>
                                Add an Order
                            </v-card-title>
    
                            <v-form @submit.prevent="Save">
                                <v-text-field
                                v-model="form.quantity"
                                outlined
                                label ="Enter Quantity"
                                required
                                
                                
                                />
                                <v-file-input
                                v-model="form.logo_image"
                                label="  logo Image"
                                prepend-icon=""
                                />
    
                                <v-text-field
                                v-model="form.front_text"
                                label ="Enter front text"
                                reuired
                                
                                />
    
                                <v-text-field
                                v-model="form.back_text"
                                label ="Enter back text"
                                
                                
                                />
                                <v-text-field
                                v-model="form.total_price"
                                label ="Enter price"
                                required
                                />
                                <v-select
                                v-model="form.status"
                                :items="['pending', 'completed', 'canceled']"
                                label="status"
                                required
                                
                               
                                />
                                <v-select
                                v-model="form.payment_status"
                                :items="['paid', 'unpaid']"
                                label="payment_status"
                                required
                                />

                                <v-select
                                v-model="form.gender"
                                :items="['men', 'women', 'unisex', 'kids']"
                                label="gender"
                                required
                                />
                                
                                <v-select
                                v-model="form.sizes"
                                :items="['XS', 'S', 'M','L','XL','XXL','3XL','4XL','5XL',
                                '2T','3T','4T','6-7','8-10','10-12','12-14'
                                ]"
                                label="Enter Size"
                                required
                                
                                />
                        
    
                                <v-btn type="submit" color="primary">Submit</v-btn>
    
                             
    
                            </v-form>
    
                        </div>
    
                    </v-col>
                </v-row>
            </v-card-text>
    
        </v-card>
    
    </section>
    
    </template>
    <script>
    import Default from '@/Layouts/Default.vue';
    export default{
        layout:Default,
        data(){
            return{
                form:this.$inertia.form({
                    quantity: '',
                    logo_image: '',
                    front_text :  '',
                    back_text: '',
                    total_price: '',
                    status: '',
                    payment_status: '',
                    gender:'',
                    sizes:'',
    
                })
                   
                
            }
        },
    
        methods:{
            Save(){
                this.form.post(route('order.store'),{
                    onerror:()=>{
                        this.form.processing = null
                    },
    
                    onSuccess:()=>{
                        this.form.reset()
                    },
                })
            }
        }
    
    
    }
    
    </script>