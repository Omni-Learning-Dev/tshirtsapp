<template>
    <v-container class="mt-5" fluid>
        <v-card class="glass pa-5">

            <v-toolbar class="mb-5 rounded-lg">
                <v-toolbar-title>
                    Order
                </v-toolbar-title>
                <v-spacer/>

                <v-btn variant="flat" class="mr-3"  :href="`/order/order-add-client/`+$page.props.order.id">
                    Back
                </v-btn>
            </v-toolbar>
            <v-row>
                <v-col cols="12" sm="6">
                    <v-card>
                        <v-card-text>
                            <h1>Summary | Order for {{ $page.props.category.name }}(s)</h1>
                            <v-table>
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-left">Size</th>
                                        <th class="text-left">Unit price</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">USD Price</th>
                                        <th class="text-left">RTGS Price</th>
                                        <th class="text-left">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(size, index) in $page.props.order.quantities" :key="index">
                                        <td>{{ size.size }}</td>
                                        <td>$ {{ getPriceForSize(size.size, 'usd') }}</td>
                                        <td>{{ size.quantity }} </td>
                                        <td>{{ getPriceForSize(size.size, 'usd') * size.quantity }}</td>
                                        <td>{{ getPriceForSize(size.size, 'rtgs') * size.quantity }}</td>
                                        <td>
                                            <v-btn color="error" @click="removeSize(size.id)">
                                                <v-icon>mdi-trash-can</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Totals</strong></td>
                                        <td><strong> </strong></td>
                                        <td><strong>{{ totalQuantities }}</strong></td>
                                        <td><strong>{{ totalUSD }}</strong></td>
                                        <td><strong>{{ totalRTGS }}</strong></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-table>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Payment or Additional Details Section -->
                <v-col cols="12" sm="6">
                    <!-- Add payment or additional details here -->
                    <v-card>
                        <v-card-text>
                            <h1>Payment Details</h1>
                            <!-- Add payment form or details here -->
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
import Default from '@/Layouts/Default.vue';

export default {
    layout: Default,

    computed: {
        // Calculate total quantities
        totalQuantities() {
            return this.$page.props.order.quantities.reduce((total, size) => total + size.quantity, 0);
        },

        // Calculate total USD price
        totalUSD() {
            return this.$page.props.order.quantities.reduce((total, size) => {
                return total + this.getPriceForSize(size.size, 'usd') * size.quantity;
            }, 0);
        },

        // Calculate total RTGS price
        totalRTGS() {
            return this.$page.props.order.quantities.reduce((total, size) => {
                return total + this.getPriceForSize(size.size, 'rtgs') * size.quantity;
            }, 0);
        },
    },

    methods: {
        // Get price for a specific size and currency
        getPriceForSize(size, currency = 'usd') {
            const priceEntry = this.$page.props.prices.find(price => price.size === size);
            if (!priceEntry) return 0;
            return currency === 'usd' ? priceEntry.usd_price : priceEntry.rtgs_price;
        },


        removeSize(index) {

            this.$inertia.delete(route('order.removeSize', { order: this.$page.props.order.id, index }), {
                onSuccess: () => {
                    this.$toast.success('Size removed successfully!');
                },
                onError: () => {
                    this.$toast.error('Failed to remove size.');
                },
            });
        },
    },
};
</script>

