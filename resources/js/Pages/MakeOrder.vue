<template>
    <Default>
        <v-container class="mt-5" fluid>
            <v-card class="glass pa-5">
                <v-row>
                    <v-col cols="12" sm="6" class="text-center">
                        <h1 class="mt-5">
                            {{ $page.props.category.name }}
                        </h1>
                        <img :src="$page.props.category.preview_image" cover />
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-form @submit.prevent="submitOrder">
                            <v-card variant="flat" class="mt-10 mr-5">
                                <v-card-text>
                                    <v-stepper v-model="step"
                                        :items="['Branding Details', 'Size & Quantities', 'Order Summery',]"
                                        elevation="0">
                                        <template v-slot:item.1>
                                            <v-card flat class="pt-10">
                                                <v-row>
                                                    <v-col cols="6">
                                                        <v-text-field v-model="form.front_text" label="Front Text"
                                                            variant="outlined"
                                                            :error-messages="$page.props.errors?.front_text" />
                                                        <v-text-field v-model="form.back_text" label="Back Text"
                                                            variant="outlined"
                                                            :error-messages="$page.props.errors?.back_text" />
                                                    </v-col>

                                                    <v-col cols="6">
                                                        <v-file-input density="comfortable" v-model="form.logo_image"
                                                            label="Upload Logo or image" accept="image/*"
                                                            variant="outlined" prepend-icon=""
                                                            prepend-inner-icon="mdi-camera"
                                                            :error-messages="$page.props.errors?.logo_image"
                                                            @update:model-value="previewImage" />

                                                        <v-img v-if="imagePreview" :src="imagePreview" max-height="150"
                                                            contain class="mt-n2" />
                                                        <v-img v-else src="/images/logo-main.png" max-width="150"
                                                            contain class="glass mt-n2" />
                                                    </v-col>
                                                </v-row>

                                                <v-textarea rows="3" v-model="form.notes"
                                                    label="Additional Details and Instructions" variant="outlined"
                                                    :error-messages="$page.props.errors?.notes" />
                                            </v-card>
                                        </template>

                                        <template v-slot:item.2>
                                            <v-toolbar density="comfortable" rounded>
                                                <v-spacer />
                                                <v-btn @click="addSizeToArray" variant="flat"> Add Size </v-btn>
                                            </v-toolbar>

                                            <v-card flat class="pt-10">
                                                <v-row v-for="(size, index) in form.sizes" :key="index">
                                                    <v-col cols="12" sm="3">
                                                        <v-select v-model="size.size"
                                                            :items="$page.props.category.sizes" label="Size"
                                                            variant="outlined"
                                                            :error-messages="$page.props.errors?.sizes?.[index]?.size" />
                                                    </v-col>
                                                    <v-col cols="12" sm="3">
                                                        <v-select v-model="size.gender"
                                                            :items="$page.props.category.gender"></v-select>
                                                    </v-col>

                                                    <v-col cols="12" sm="3">
                                                        <v-text-field label="Quantity"
                                                            v-model="size.quantity"></v-text-field>
                                                    </v-col>

                                                    <v-col cols="12" sm="2">
                                                        <v-btn @click="removeSizeFromArray(index)" class="mb-1"
                                                            color="error">
                                                            <v-icon>mdi-trash-can</v-icon>
                                                        </v-btn>
                                                    </v-col>
                                                </v-row>
                                            </v-card>
                                        </template>

                                        <template v-slot:item.3>
                                            <v-card flat>
                                                <h1>Order for {{ $page.props.category.name }}(s)</h1>
                                                <div v-for="(size, index) in form.sizes" :key="index">
                                                    <div>
                                                        <strong>Size {{ size.size }}</strong> - Quantity: {{
                                                            size.quantity }}
                                                    </div>
                                                    <div>
                                                        USD Price: ${{ getPriceForSize(size.size, 'usd') * size.quantity
                                                        }}
                                                    </div>
                                                    <div>
                                                        RTGS Price: RTGS {{ getPriceForSize(size.size, 'rtgs') *
                                                            size.quantity }}
                                                    </div>
                                                </div>

                                                <v-divider></v-divider>
                                                <h1 class="my-3">Client Details</h1>

                                                <v-row>
                                                    <v-col>

                                                        <v-text-field v-model="form.client.phone" label="Client Phone"
                                                            :rules="[v => !!v || 'Phone number is required']"
                                                            required></v-text-field>
                                                    </v-col>
                                                    <v-col>
                                                        <v-text-field v-model="form.client.email" label="Client Email"
                                                            :rules="[v => !v || /.+@.+\..+/.test(v) || 'E-mail must be valid']"
                                                            required></v-text-field>
                                                    </v-col>
                                                </v-row>

                                                <v-text-field v-model="form.client.name" label="Client Name"
                                                    :rules="[v => !!v || 'Client name is required']"
                                                    required></v-text-field>



                                                <v-row>
                                                    <v-col>
                                                        <v-textarea rows="3" v-model="form.client.address"
                                                            label="Client Address"
                                                            :rules="[v => !!v || 'Address is required']"
                                                            required></v-textarea>
                                                    </v-col>
                                                    <v-col>
                                                        <v-select v-model="form.client.gender"
                                                            :items="['male', 'female',]" label="Client Gender"
                                                            :rules="[v => !!v || 'Gender is required']"
                                                            required></v-select>
                                                    </v-col>
                                                </v-row>


                                            </v-card>
                                        </template>

                                        <template v-slot:actions>
                                            <div class="d-flex glass">
                                                <v-btn @click="step--" :disabled="step === 1"
                                                    variant="outlined">Previous </v-btn>
                                                <v-spacer></v-spacer>
                                                <v-btn @click="step++" v-if="step < 3" class="mx-1">Next </v-btn>
                                                <v-btn type="submit" v-if="step > 2" class="mx-1"> Submit Order </v-btn>
                                            </div>
                                        </template>
                                    </v-stepper>
                                </v-card-text>
                            </v-card>
                        </v-form>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </Default>
</template>

<script>
    import Default from '@/Layouts/Default.vue';
    import Model from '@/Layouts/Model.vue';

    export default {
        components: {
            Model,
            Default,
        },

        data() {
            return {
                step: 1,
                imagePreview: null,
                form: this.$inertia.form({
                    category_id: this.$page.props.category.id, // Set category_id dynamically
                    logo_image: null,
                    notes: null,
                    front_text: null,
                    back_text: null,
                    payment_status: null,
                    status: null,

                    sizes: [
                        {
                            size: null,
                            quantity: null,
                            gender: null,
                        },
                    ],

                    client: {
                        name: null,
                        email: null,
                        phone: null,
                        address: null,
                        gender: null,
                        company_name: null,
                    }
                }),
            };
        },

        methods: {
            addSizeToArray() {
                this.form.sizes.push({
                    size: null,
                    quantity: null,
                    gender: null,
                });
            },

            removeSizeFromArray(index) {
                this.form.sizes.splice(index, 1);
            },




            previewImage(file) {
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                } else {
                    this.imagePreview = null;
                }
            },
            submitOrder() {
                this.form.post(this.route('sendOrder'), {});
            },

            getPriceForSize(size, currency = 'usd') {
                const priceEntry = this.$page.props.category.prices.find(price => price.size === size);
                if (!priceEntry) return 0;
                return currency === 'usd' ? priceEntry.usd_price : priceEntry.rtgs_price;
            },

            getClientByPhone(phone) {
                const client = this.$page.props.clients.find(phone => form.client.phone === phone);

                if (client) {
                    return client;
                } else {
                    return 0;
                }
            }
        },
    };
</script>
