<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    export default {
        components: { AppLayout },
        data() {
            return {
                showDialog: false,
                editingPrice: null,
                searchQuery: '',
                form: this.$inertia.form({
                    id: null, // Add id to the form for updating
                    category_id: '',
                    size: '',
                    gender: '',
                    usd_price: '',
                    rtgs_price: ''
                }),
            };
        },
        methods: {
            openAddDialog() {
                this.form.reset();
                this.form.id = null; // Reset id for new entry
                this.showDialog = true;
            },
            submitPrice() {
                this.form.post(route('admin.prices.store'), {
                    onSuccess: () => {
                        this.showDialog = false;
                        this.form.reset();
                    }
                });
            },
            openEditDialog(price) {
                this.editingPrice = price;
                this.form.id = price.id; // Set id for updating
                this.form.category_id = price.category_id;
                this.form.size = price.size;
                this.form.gender = price.gender;
                this.form.usd_price = price.usd_price;
                this.form.rtgs_price = price.rtgs_price;
                this.showDialog = true;
            },
            deletePrice(priceToDelete) {

                this.$swal.fire({
                    title: "Are you sure you want to delete this price?" + priceToDelete.category.name,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Yes, delete it",
                    denyButtonText: `No, keep it`
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.visit(route('admin.prices.destroy', priceToDelete.id), {
                            method: 'delete',
                            onSuccess:()=>{
                                this.$swal.fire({
                                    title: "Deleted",
                                    text:'Price deleted successfully',
                                    icon:'success'
                                })
                            }
                        });
                    }
                });
            },
        }
    };
</script>

<template>
    <AppLayout>
        <v-container>
            <v-toolbar class="mb-5">
                <v-toolbar-title>Categories & Prices</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn variant="flat" size="large" color="primary" @click="openAddDialog">
                    Add New Price
                </v-btn>
            </v-toolbar>

            <v-table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Gender</th>
                        <th>USD Price</th>
                        <th>RTGS Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="price in $page.props.prices" :key="price.id">
                        <td>{{ price.category.name }}</td>
                        <td>{{ price.size }}</td>
                        <td>{{ price.gender }}</td>
                        <td>${{ price.usd_price }}</td>
                        <td>RTGS {{ price.rtgs_price }}</td>
                        <td>
                            <v-btn icon="mdi-pencil" size="small" class="mr-2" @click="openEditDialog(price)"></v-btn>
                            <v-btn icon="mdi-delete" size="small" color="error" @click="deletePrice(price)"></v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>

            <!-- Price Dialog -->
            <v-dialog v-model="showDialog" max-width="500px">
                <v-card>
                    <v-card-title>{{ form.id ? 'Edit Price' : 'Add New Price' }}</v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="submitPrice">
                            <v-select v-model="form.category_id" :items="$page.props.categories" item-title="name"
                                item-value="id" label="Category" variant="outlined"
                                :error-messages="form.errors.category_id" class="mb-4"></v-select>

                            <v-select v-model="form.size"
                                :items="$page.props.categories.find(c => c.id === form.category_id)?.sizes || []"
                                label="Size" variant="outlined" :error-messages="form.errors.size"
                                class="mb-4"></v-select>

                            <v-select v-model="form.gender"
                                :items="$page.props.categories.find(c => c.id === form.category_id)?.gender || []"
                                label="Gender" variant="outlined" :error-messages="form.errors.gender"
                                class="mb-4"></v-select>

                            <v-text-field v-model="form.usd_price" label="USD Price" type="number" step="0.01"
                                variant="outlined" :error-messages="form.errors.usd_price" class="mb-4"></v-text-field>

                            <v-text-field v-model="form.rtgs_price" label="RTGS Price" type="number" step="0.01"
                                variant="outlined" :error-messages="form.errors.rtgs_price" class="mb-4"></v-text-field>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn variant="flat" color="error" @click="showDialog = false">Cancel</v-btn>
                                <v-btn variant="flat" color="primary" type="submit" :loading="form.processing">{{
                                    form.id ? 'Update' : 'Save' }}</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </v-container>
    </AppLayout>
</template>
