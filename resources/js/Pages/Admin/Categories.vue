<template>
    <AppLayout>
        <div class="glass pa-3">
            <v-toolbar class="rounded-lg px-2 mb-5" density="comfortable">
                <v-toolbar-title>
                    All Categories
                </v-toolbar-title>
                <v-spacer />
                <v-btn v-if="!dialog" @click="dialog = true" variant="flat">
                    Add Category
                </v-btn>

                <v-btn v-else @click="dialog = false" variant="flat">
                    Back to Category
                </v-btn>
            </v-toolbar>

                    <div max-width="700" v-if="dialog">
                <v-card variant="flat">
                    <v-card-title class="mb-5">
                        Category Form
                            </v-card-title>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="form.name"
                                            label="Category Name"
                                            prepend-inner-icon="mdi-account"
                                            :rules="[rules.required]"
                                            :error-messages="form.errors.name"
                                        />
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <v-file-input
                                            v-model="form.preview_image"
                                            label="  logo Image"
                                            prepend-icon=""
                                            density="comfortable"
                                            prepend-inner-icon="mdi-image"
                                            variant="outlined"
                                        />
                                    </v-col>
                                </v-row>
                                <v-row class="mt-n3">
                                    <v-col cols="12" md="6">
                                        <v-textarea
                                            v-model="form.description"
                                            label="Description "
                                            prepend-inner-icon="mdi-account"
                                            :rules="[rules.required]"
                                            :error-messages="form.errors.description"
                                        />
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-select
                                            multiple
                                            chips
                                            closable-chips
                                            v-model="form.gender"
                                            :items="['men', 'women', 'unisex','kids']"
                                            label="Gender"
                                            prepend-inner-icon="mdi-gender-male-female"
                                            :error-messages="form.errors.gender"
                                        />

                                        <v-select
                                            multiple
                                            chips
                                            closable-chips
                                            v-model="form.sizes"
                                            :items="['XS', 'S', 'M','L','XL','XXL','3XL','4XL','5XL',
                                                '2T','3T','4T','6-7','8-10','10-12','12-14'
                                            ]"
                                            label="Enter Size"
                                            prepend-inner-icon="mdi-gender-male-female"
                                            :error-messages="form.errors.gender"
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
                    :items="$page.props.categories"
                    :headers="headers"
                    >
                        <template v-slot:item.preview_image="{ item }">
                            <v-img
                                :src="item.preview_image"
                                height="60"
                                width="60"
                                class="glass ma-1"
                            />
                        </template>
                        <template v-slot:item.gender="{ item }">
                            <v-chip
                                v-if="item.gender"
                                v-for="(genderName, i) in item.gender"
                                class="ma-1"
                                color="primary"
                                density="compact"
                            >
                                {{ genderName }}
                            </v-chip>
                        </template>

                        <template v-slot:item.sizes="{ item }">
                            <v-chip
                                v-if="item.sizes"
                                v-for="(sizeName, i) in item.sizes"
                                class="ma-1"
                                color="success"
                                density="compact"
                            >
                                {{ sizeName }}
                            </v-chip>
                        </template>

                        <template v-slot:item.actions="{ item }">
                        <div class="d-flex">
                            <v-btn class="mx-1" color="success" @click="showCategory(item)">
                                View
                            </v-btn>

                            <v-btn class="mx-1" @click="editCategory(item)">
                                Edit
                            </v-btn>

                            <v-btn color="error" class="mx-1" @click="deleteCategory(item)">
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


import {router} from "@inertiajs/vue3";
export default {
    components: {AppLayout},
    data() {
        return {
            form: this.$inertia.form({
                id:null,
                name: null,
                preview_image: null,
                description: null,
                gender: null,
                sizes: null,

            }),
            headers: [
                { title: 'ID', key: 'id' },
                { title: 'Image', key: 'preview_image' },
                { title: 'Category', key: 'name' },
                { title: 'Gender', key: 'gender' },
                { title: 'Sizes', key: 'sizes' },
                { title: 'Actions', key: 'actions', sortable: false },
            ],
            dialog: false,
            rules: {
                required: (value) => !!value || 'This field is required.',
                email: (value) => {
                    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return pattern.test(value) || 'Invalid e-mail.';
                },
            },
        };
    },


    methods: {
        submitForm() {
            this.form.post(route('admin.categories.store'), {
                onSuccess: () => {
                    this.closeDialog();
                },
            });
        },
        closeDialog() {
            this.dialog = false;
            this.form.reset();
        },


        editCategory(category) {
            this.form.id = category.id;
            this.form.name = category.name;
            this.form.preview_image = category.preview_image;
            this.form.description = category.description;
            this.form.gender = category.gender;
            this.form.sizes = category.sizes;
            this.dialog = true;
        },
        deleteCategory(category) {
            this.$swal.fire({
                title: "Are you sure you want to delete this category?"+ category.name,
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Yes, delete it",
                denyButtonText: `No, keep it`
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.visit(route('admin.categories.destroy',category.id), {
                        method: 'delete'
                    });
                }
            });
        },


    },
};
</script>

