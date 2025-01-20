<template>
    <Default>
        <v-container class="mt-5" fluid >
            <v-toolbar class="rounded-lg mb-5">
                <v-toolbar-title>
                    {{ $page.props.category.name }}
                </v-toolbar-title>
            </v-toolbar>
            <v-row>
                <v-col cols="12" sm="6">
                    <v-img
                        :src="$page.props.category.preview_image"
                        height="350"
                        contain
                    />
                </v-col>
                <v-col cols="12" sm="6">
                    <v-form @submit.prevent="submitOrder">
                        <v-card class="pa-4">
                            <v-card-title>Place Your Order</v-card-title>

                            <v-card-text>
                                <v-row>
                                    <v-col cols="6">
                                        <v-select
                                            chips
                                            closable-chips
                                            v-model="form.size"
                                            label="Select Size"
                                            :items="$page.props.category.sizes"
                                            variant="outlined"
                                            :error-messages="$page.props.errors?.size"
                                            required
                                        />
                                    </v-col>

                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="form.quantity"
                                            label="Quantity"
                                            type="number"
                                            variant="outlined"
                                            :error-messages="$page.props.errors?.quantity"
                                            required
                                        />
                                    </v-col>

                                    <v-col cols="6">
                                        <v-file-input
                                            v-model="form.logo_image"
                                            label="Upload Logo"
                                            accept="image/*"
                                            variant="outlined"
                                            prepend-icon=""
                                            :error-messages="$page.props.errors?.logo_image"
                                            @update:model-value="previewImage"
                                        />
                                    </v-col>

                                    <v-col cols="6">
                                        <v-img
                                            v-if="imagePreview"
                                            :src="imagePreview"
                                            max-height="150"
                                            contain
                                            class="mt-n2"
                                        />
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="form.front_text"
                                            label="Front Text"
                                            variant="outlined"
                                            :error-messages="$page.props.errors?.front_text"
                                        />
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="form.back_text"
                                            label="Back Text"
                                            variant="outlined"
                                            :error-messages="$page.props.errors?.back_text"
                                        />
                                    </v-col>

                                    <v-col cols="12">
                                        <v-select
                                            v-model="form.gender"
                                            label="Gender"
                                            chips
                                            closable-chips
                                            :items="['men', 'women', 'unisex', 'kids']"
                                            variant="outlined"
                                            :error-messages="$page.props.errors?.gender"
                                            required
                                        />
                                    </v-col>
                                </v-row>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer />
                                <v-btn
                                    color="primary"
                                    type="submit"
                                    variant="flat"
                                    size="large"
                                    :loading="form.processing"
                                >
                                    Place Order
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
        </v-container>
    </Default>
</template>

<script>
import Default from "@/Layouts/Default.vue";

export default {
    components:{
        Default
    },

    data() {
        return {
            imagePreview: null,
            form: this.$inertia.form({
                quantity: null,
                category_id: this.$page.props.category.id, // Set category_id dynamically
                logo_image: null,
                notes: null,
                front_text: null,
                back_text: null,
                gender: null,
                size: null,
            }),
        };
    },

    methods: {
        previewImage(file) {
            if (file) {
                this.imagePreview = URL.createObjectURL(file);
            } else {
                this.imagePreview = null;
            }
        },
        submitOrder() {
            this.form.post(this.route('sendOrder'), {

            });
        },
    },
}
</script>
