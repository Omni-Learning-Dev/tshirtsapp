<template>
    <AppLayout>
        <div class="glass pa-3">
            <v-toolbar class="rounded-lg px-2 mb-5" density="comfortable">
                <v-toolbar-title> All Products </v-toolbar-title>
                <v-spacer />
                <v-btn v-if="!dialog" @click="dialog = true" variant="flat">
                    Add Product
                </v-btn>

                <v-btn v-else @click="dialog = false" variant="flat">
                    Back to Products
                </v-btn>
            </v-toolbar>

            <div max-width="700" v-if="dialog">
                <v-card variant="flat">
                    <v-card-title class="mb-5"> Product Form </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="form.product_name"
                                    label="Product Name"
                                    prepend-inner-icon="mdi-package-variant"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.product_name"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="form.category_id"
                                    :items="$page.props.categories"
                                    item-title="name"
                                    item-value="id"
                                    label="Category"
                                    prepend-inner-icon="mdi-shape"
                                    :error-messages="form.errors.category_id"
                                />
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="form.price"
                                    label="Price"
                                    type="number"
                                    step="0.01"
                                    prepend-inner-icon="mdi-currency-usd"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.price"
                                />
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="form.stock"
                                    label="Stock"
                                    type="number"
                                    prepend-inner-icon="mdi-package-variant"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.stock"
                                />
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-select
                                    v-model="form.size"
                                    :items="[
                                        'XS',
                                        'S',
                                        'M',
                                        'L',
                                        'XL',
                                        'XXL',
                                        '3XL',
                                    ]"
                                    label="Size"
                                    prepend-inner-icon="mdi-ruler"
                                    :error-messages="form.errors.size"
                                />
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="form.color"
                                    :items="[
                                        'Red',
                                        'Blue',
                                        'Green',
                                        'Black',
                                        'White',
                                        'Yellow',
                                        'Purple',
                                    ]"
                                    label="Color"
                                    prepend-inner-icon="mdi-palette"
                                    :error-messages="form.errors.color"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-file-input
                                    v-model="form.image_url"
                                    label="Product Image"
                                    prepend-icon=""
                                    density="comfortable"
                                    prepend-inner-icon="mdi-image"
                                    variant="outlined"
                                    :error-messages="form.errors.image_url"
                                />
                            </v-col>
                        </v-row>
                    </v-card-text>

                    <v-card-actions class="mt-n5">
                        <v-btn
                            class="mx-1"
                            variant="flat"
                            color="warning"
                            @click="closeDialog"
                        >
                            Cancel
                        </v-btn>

                        <v-btn
                            variant="flat"
                            class="mx-1"
                            color="primary"
                            @click="submitForm"
                            :loading="form.processing"
                        >
                            Submit
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </div>

            <v-data-table
                v-else
                :items="$page.props.products"
                :headers="headers"
            >
                <template v-slot:item.image_url="{ item }">
                    <v-img
                        :src="item.image_url"
                        height="60"
                        width="60"
                        class="glass ma-1"
                    />
                </template>

                <template v-slot:item.price="{ item }">
                    ${{ item.price }}
                </template>

                <template v-slot:item.actions="{ item }">
                    <div class="d-flex">
                        <v-btn
                            class="mx-1"
                            color="success"
                            @click="showProduct(item)"
                        >
                            View
                        </v-btn>

                        <v-btn class="mx-1" @click="editProduct(item)">
                            Edit
                        </v-btn>

                        <v-btn
                            color="error"
                            class="mx-1"
                            @click="deleteProduct(item)"
                        >
                            <v-icon>mdi-trash-can</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue"; 

export default {
    components: { AppLayout },
    data() {
        return {
            form: this.$inertia.form({
                id: null,
                product_name: null,
                category_id: null,
                price: null,
                size: null,
                color: null,
                stock: null,
                image_url: null,
            }),
            headers: [
                 
                { title: "Image", key: "image_url" },
                { title: "Product Name", key: "product_name" },
                { title: "Price", key: "price" },
                { title: "Size", key: "size" },
                { title: "Color", key: "color" },
                { title: "Stock", key: "stock" },
                { title: "Actions", key: "actions", sortable: false },
            ],
            dialog: false,
            rules: {
                required: (value) => !!value || "This field is required.",
            },
        };
    },

    methods: {
        submitForm() {
            this.form.post(route("admin.products.store"), {
                    onSuccess: () => {
                        this.closeDialog();
                    },
                });
        },

        closeDialog() {
            this.dialog = false;
            this.form.reset();
        },

        editProduct(product) {
            this.form.id = product.id;
            this.form.product_name = product.product_name;
            this.form.category_id = product.category_id;
            this.form.price = product.price;
            this.form.size = product.size;
            this.form.color = product.color;
            this.form.stock = product.stock;
            this.form.image_url = product.image_url;
            this.dialog = true;
        },

        deleteProduct(product) {
            this.$swal
                .fire({
                    title:
                        "Are you sure you want to delete this product? " +
                        product.product_name,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Yes, delete it",
                    denyButtonText: `No, keep it`,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.visit(
                            route("admin.products.destroy", product.id),
                            {
                                method: "delete",
                            }
                        );
                    }
                });
        },
    },
};
</script>
