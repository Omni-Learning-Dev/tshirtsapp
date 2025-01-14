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
                                    :error-messages="form.errors.first_name"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="form.slug"
                                    label="Enter slug "
                                    prepend-inner-icon="mdi-account"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.last_name"
                                />
                            </v-col>
                        </v-row>
                        <v-row class="mt-n3">
                            <v-col cols="12" md="6">
                                
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="form.description"
                                    label="Description "
                                    prepend-inner-icon="mdi-account"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.description"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="form.gender"
                                    :items="['men', 'women', 'unisex','kids']"
                                    label="Gender"
                                    prepend-inner-icon="mdi-gender-male-female"
                                    :error-messages="form.errors.gender"
                                />
                            </v-col>
                        </v-row>
                        <v-col cols="12" md="6">
                                <v-select
                                    v-model="form.sizes"
                                    :items="['XS', 'S', 'M','L','XL','XXL','3XL','4XL','5XL',
                                        '2T','3T','4T','6-7','8-10','10-12','12-14'
                                    ]"
                                    label="Enter Size"
                                    prepend-inner-icon="mdi-gender-male-female"
                                    :error-messages="form.errors.gender"
                                />
                            </v-col>
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
    data() {
        return {
            form: this.$inertia.form({
                id:null,
                name: null,
                slug: null,
                preview_image: null,
                description: null,
                gender: null,
                sizes: null,

            }),
            headers: [
                { title: 'ID', key: 'id' },
                { title: 'Category Name', key: 'name' },
                { title: 'Enter slug', key: 'slug' },
                { title: 'Description', key: 'description' },
                // { title: 'Phone Number', key: 'phone_number' },
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

    mounted(){
        this.$swal.fire({})
    },
    methods: {
        submitForm() {
            this.form.post(route('category.store'), {
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
            this.form.slug = category.slug;
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
                    this.$inertia.visit(route('category.destroy',category.id), {
                        method: 'delete'
                    });
                }
            });
        },

       
    },
};
</script>

