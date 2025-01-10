<template>
<section class="contact-hero">
    <v-container>
        <div class="text-center mb-3 mt-5">
            <h1 class="hero-h12 text-white">
                Contact Us
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
                            Contact Form
                        </v-card-title>

                        <v-form @submit.prevent="">
                            <v-text-field
                            v-model="form.name"
                            outlined
                            label ="Enter your name"
                            required
                            
                            
                            />

                            <v-text-field
                            v-model="form.email"
                            label ="Enter your Email"
                            reuired
                            
                            />

                            <v-text-field
                            v-model="form.phone"
                            label ="Enter your phone number"
                            
                            
                            />
                            <v-textarea
                            v-model="form.message"
                            label ="message"
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
export default{
    
    data(){
        return{
            form:this.$inertia.form({
                name: '',
                email: '',
                phone :  '',
                message: '',
                is_handled: '',

            })
               
            
        }
    },

    methods:{
        SendContact(){
            this.form.post(route(''),{
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