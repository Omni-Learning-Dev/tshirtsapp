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
                        <v-form @submit.prevent="submitOrder" v-if="$page.props.tab ==='two'">
                            <v-card flat class="pt-5">
                                <v-toolbar density="comfortable" rounded color="transparent">
                                    <h1 class="ml-5 text-accent">
                                        Add Quantities to Order
                                    </h1>
                                    <v-spacer />
                                    <v-btn @click="addSizeToArray" variant="flat"> <v-icon>mdi-plus</v-icon> Add Size </v-btn>
                                </v-toolbar>

                                <v-divider class="mb-3"/>

                                <v-card-text>
                                    <v-row v-for="(size, index) in form.sizes" :key="index">
                                        <!-- Size Select -->
                                        <v-col cols="12" sm="3">
                                            <v-select
                                                v-model="size.size"
                                                :items="$page.props.category.sizes"
                                                label="Size"
                                                variant="outlined"
                                                :error-messages="getErrorMessages(`sizes.${index}.size`)"
                                            ></v-select>
                                        </v-col>

                                        <!-- Gender Select -->
                                        <v-col cols="12" sm="3">
                                            <v-select
                                                v-model="size.gender"
                                                :items="$page.props.category.gender"
                                                label="Gender"
                                                variant="outlined"
                                                :error-messages="getErrorMessages(`sizes.${index}.gender`)"
                                            ></v-select>
                                        </v-col>

                                        <!-- Quantity Input -->
                                        <v-col cols="12" sm="3">
                                            <v-text-field
                                                v-model="size.quantity"
                                                label="Quantity"
                                                type="number"
                                                :error-messages="getErrorMessages(`sizes.${index}.quantity`)"
                                            ></v-text-field>
                                        </v-col>

                                        <!-- Remove Button -->
                                        <v-col cols="12" sm="2">
                                            <v-btn @click="removeSizeFromArray(index)" class="mb-1" color="error">
                                                <v-icon>mdi-trash-can</v-icon>
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn :loading="form.processing" type="submit" variant="flat" class="mx-1 pa-3">
                                        Next Step
                                    </v-btn>
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
                sizes: [
                    {
                        size: null,
                        quantity: null,
                        gender: null,
                    },
                ],
            }),
        };
    },

    methods: {
        submitOrder() {
            this.form.post(this.route('sendOrderQuantities'), {
                onSuccess: () => {
                    // Reset the form after successful submission
                    this.form.sizes = [
                        {
                            size: null,
                            quantity: null,
                            gender: null,
                        },
                    ];
                },
            });
        },

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

        // Helper method to get error messages for nested fields
        getErrorMessages(field) {
            return this.$page.props.errors?.[field] || [];
        },
    }
};
</script>
