<template>

        <v-container class="mt-5" fluid>
            <v-card class="glass pa-5">
                <v-toolbar class="mb-5 rounded-lg">
                    <v-toolbar-title>
                        Order
                    </v-toolbar-title>
                    <v-spacer/>

                    <v-btn variant="flat" class="mr-3"  :href="`/order/initiated/`+$page.props.order.id">
                        Back
                    </v-btn>
                </v-toolbar>

                <v-row>
                    <v-col cols="12" sm="6" class="text-center">
                        <h1 class="mt-5 text-accent text-h1">
                            {{ $page.props.category.name }}
                        </h1>
                        <img :src="$page.props.category.preview_image" :alt="$page.props.category.name" />
                    </v-col>

                    <v-col cols="12" sm="6">
                        <v-form @submit.prevent="submitOrder" v-if="$page.props.tab ==='three'">
                            <v-card flat class="pt-5">
                                <v-toolbar density="comfortable" rounded color="transparent">
                                    <h1 class="ml-5 text-accent">
                                        Add Your Details
                                    </h1>
                                    <v-spacer />
                                    <v-btn @click="addSizeToArray" variant="flat"> <v-icon>mdi-plus</v-icon> Add Size </v-btn>
                                </v-toolbar>

                                <v-divider class="mb-3"/>

                                <v-card-text>
                                    <h1 class="my-3">Client Details</h1>

                                    <v-row>
                                        <v-col>

                                            <v-text-field v-model="form.phone" label="Client Phone"
                                                          :rules="[v => !!v || 'Phone number is required']"
                                                          required></v-text-field>
                                        </v-col>
                                        <v-col>
                                            <v-text-field v-model="form.email" label="Client Email"
                                                          :rules="[v => !v || /.+@.+\..+/.test(v) || 'E-mail must be valid']"
                                                          required></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-text-field v-model="form.name" label="Client Name"
                                                  :rules="[v => !!v || 'Client name is required']"
                                                  required></v-text-field>



                                    <v-row>
                                        <v-col>
                                            <v-textarea rows="3" v-model="form.address"
                                                        label="Client Address"
                                                        :rules="[v => !!v || 'Address is required']"
                                                        required></v-textarea>
                                        </v-col>
                                        <v-col>
                                            <v-select v-model="form.gender"
                                                      :items="['male', 'female',]" label="Client Gender"
                                                      :rules="[v => !!v || 'Gender is required']"
                                                      required></v-select>
                                        </v-col>
                                    </v-row>
                                </v-card-text>

                                <v-card-actions class="glass">
                                    <v-spacer/>
                                        <v-btn :loading="form.processing" type="submit" variant="flat" class="mx-1 pa-3">
                                            Submit & Make Payment
                                        </v-btn>
                                    <v-spacer/>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>

</template>


<script>
import Default from '@/Layouts/Default.vue';

export default {
    layout:Default,

    data() {
        return {
            form: this.$inertia.form({
                order_id: this.$page.props.order.id, // Set order_id dynamically
                name: null,
                email: null,
                phone: null,
                address: null,
                gender: null,
                company_name: null,
            }),
        };
    },

    methods: {
        submitOrder() {
            this.form.post(this.route('addClientToOrder'), {
                onSuccess: () => {

                },
            });
        },

        getClientByPhone(phone) {
            const client = this.$page.props.clients.find(phone => form.client.phone === phone);
            if (client) {
                return client;
            } else {
                return 0;
            }
        },




    }
};
</script>
