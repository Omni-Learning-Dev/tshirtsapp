<template>
    <div class="glass pa-3">

        <v-toolbar flat class="rounded-lg mb-5">
            <v-toolbar-title>All Orders</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" label="Search" single-line
                          hide-details density="compact" class="mr-4"></v-text-field>
            <v-spacer></v-spacer>
            <v-btn color="primary" class="mr-4" variant="flat" size="large" @click="dialog = true">
                <v-icon>mdi-plus</v-icon>
                Add Order
            </v-btn>

            <v-dialog v-model="dialog" max-width="800px">
                <v-card>
                    <v-card-title>
                        <span class="text-h5">Create New Order</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-text-field v-model="orderForm.quantity" label="Quantity" type="number"
                                                  required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-file-input
                                        v-model="orderForm.logo_image"
                                        label="Logo Image"
                                        accept="image/*"
                                        required
                                    />
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field v-model="orderForm.front_text" label="Front Text"
                                                  required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field v-model="orderForm.back_text" label="Back Text"
                                                  required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field v-model="orderForm.total_price" label="Total Price"
                                                  type="number" step="0.01" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select v-model="orderForm.status"
                                              :items="['pending', 'completed', 'canceled']" label="Status"
                                              required></v-select>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select v-model="orderForm.payment_status" :items="['paid', 'unpaid']"
                                              label="Payment Status" required></v-select>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select v-model="orderForm.gender"
                                              :items="['men', 'women', 'unisex', 'kids']" label="Gender"
                                              required></v-select>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select v-model="orderForm.size"
                                              :items="['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL', '2T', '3T', '4T', '6-7', '8-10', '10-12', '12-14']"
                                              label="Size" required></v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="error" @click="dialog = false">Cancel</v-btn>
                        <v-btn :loading="orderForm.processing" color="primary" @click="submitOrder">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>

        <v-data-table :headers="headers" :items="$page.props.orders" :search="search">


            <template v-slot:item.status="{ item }">
                <v-chip :color="getStatusColor(item.status)" text-color="white">
                    {{ item.status }}
                </v-chip>
            </template>

            <template v-slot:item.payment_status="{ item }">
                <v-chip :color="getPaymentStatusColor(item.payment_status)" text-color="white">
                    {{ item.payment_status }}
                </v-chip>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-btn color="error" class="mx-1" @click="deleteOrder(item)">
                    <v-icon>mdi-trash-can</v-icon>
                </v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,

    data() {
        return {
            search: "",
            headers: [
                { title: "Client", key: "client_id" },
                { title: "Front text", key: "front_text" },
                { title: "Back text", key: "back_text" },
                { title: "Status", key: "status" },
                { title: "Payment status", key: "payment_status" },

                { title: "Actions", key: "actions", sortable: false },
            ],
            dialog: false,

            orderForm: this.$inertia.form({
                quantity: null,
                logo_image: null,
                front_text: "",
                back_text: "",
                total_price: null,
                status: "pending",
                payment_status: "unpaid",
                gender: "",
                size: "",
            }),


            genderOptions: ["men", "women", "unisex", "kids"],
            sizeOptions: [
                "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL",
                "2T", "3T", "4T", "6-7", "8-10", "10-12", "12-14"
            ],
        };
    },

    methods: {

        deleteOrder(order) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete order!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.delete(route("order.destroy", order.id), {
                            onSuccess: () => {
                                this.dialog = false;
                            },
                        });
                    }
                });
        },

        submitOrder() {
            this.orderForm.post(route('admin.orders.store'), {
                onSuccess: () => {
                    this.dialog = false;
                },
            });
        },

        getStatusColor(status) {
            return {
                pending: "orange",
                completed: "green",
                canceled: "red",
            }[status] || "grey";
        },
        getPaymentStatusColor(paymentStatus) {
            return {
                paid: "green",
                unpaid: "red",
            }[paymentStatus] || "grey";
        },
    },
};
</script>
