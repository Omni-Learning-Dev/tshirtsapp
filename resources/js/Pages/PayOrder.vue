<template>
    <v-container class="mt-5" fluid>
        <v-card class="glass pa-5">
            <v-toolbar class="mb-5 rounded-lg">
                <v-toolbar-title> Order </v-toolbar-title>
                <v-spacer />

                <v-btn variant="flat" class="mr-3" :href="'/order/order-add-client/' + $page.props.order.id"> Back </v-btn>
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
                                            <th class="text-left">Gender</th>
                                            <th class="text-left">Unit price</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">USD Price</th>
                                            <th class="text-left">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(size, index) in $page.props.order.quantities" :key="index">
                                            <td>{{ size.size }}</td>
                                            <td>{{ size.gender }}</td>
                                            <td>$ {{ getPriceForSize(size.size, size.gender, 'usd') }}</td>
                                            <td>{{ size.quantity }}</td>
                                            <td>$ {{ getPriceForSize(size.size, size.gender, 'usd') * size.quantity }}</td>
                                            <td>
                                                <v-btn color="error" @click="removeSize(size.id)">
                                                    <v-icon>mdi-trash-can</v-icon>
                                                </v-btn>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>Totals</strong></td>
                                            <td><strong> </strong></td>
                                            <td>
                                                <strong>{{ totalQuantities }} Items</strong>
                                            </td>
                                            <td>
                                                <strong>$ {{ totalUSD.toFixed(2) }}</strong>
                                            </td>
                                            <!-- <td><strong>{{ totalRTGS }}</strong></td> -->
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
                    <v-card>
                        <v-tabs grow v-model="tab">
                            <v-tab value="express">
                                Express Checkout
                                <img class="mx-1" src="/icons/ecocash.jpg" height="28" alt="" />
                                <img class="mx-1" src="/icons/onemoney.png" height="28" alt="" />
                            </v-tab>

                            <v-tab value="pesepay">
                                <img class="mx-3" src="/icons/innbucks.jpg" height="40" alt="" />
                                <img class="mx-3" src="/icons/visa.jpg" height="28" alt="" />
                            </v-tab>
                        </v-tabs>
                        <v-divider></v-divider>

                        <v-tabs-window v-model="tab">
                            <v-tabs-window-item value="express">
                                <v-form v-model="valid" @submit.prevent="MakePayment">
                                    <v-card-text>
                                        <h1>Payment Details</h1>

                                        <v-text-field class="mt-5" label="Your phone number" v-model="form.customerPhoneNumber" :rules="rules.customerPhoneNumber" />

                                        <v-btn :loading="btnloading" :disabled="!valid" block class="mt-5" type="submit"> Pay Order </v-btn>
                                    </v-card-text>
                                </v-form>
                            </v-tabs-window-item>

                            <v-tabs-window-item value="pesepay">
                                <br />
                                <h1 class="mb-3 mx-5 text-accent">Make payment externally</h1>
                                <div class="d-flex pa-3">
                                    <img class="mx-3" src="/icons/ecocash.jpg" height="30" alt="" />
                                    <img class="mx-3" src="/icons/onemoney.png" height="30" alt="" />
                                    <img class="mx-3" src="/icons/innbucks.jpg" height="30" alt="" />
                                    <img class="mx-3" src="/icons/visa.jpg" height="30" alt="" />
                                </div>
                                <v-card-text>
                                    <InertiaLink class="InertiaLink" :href="route('pesePayCheckout', { order: $page.props.order.id })">
                                        <v-btn color="success" block size="x-large"> Checkout with PesePay </v-btn>
                                    </InertiaLink>
                                </v-card-text>
                            </v-tabs-window-item>
                        </v-tabs-window>
                    </v-card>
                </v-col>
            </v-row>
        </v-card>

        <div>
            <v-overlay class="border d-flex align-center justify-center" v-model="loading">
                <v-card variant="flat" width="500">
                    <v-card-text>
                        <div class="text-center">
                            <p v-html="loaderMessage"></p>
                            <v-progress-circular color="primary" indeterminate size="64">
                                {{ retries }}
                            </v-progress-circular>
                        </div>
                    </v-card-text>
                </v-card>
            </v-overlay>
        </div>
    </v-container>
</template>
<script>
import Default from '@/Layouts/Default.vue';

export default {
    layout: Default,

    data() {
        return {
            tab: null,
            form: this.$inertia.form({
                amount: null,
                order_id: this.$page.props.order.id,
                client_id: this.$page.props.order.client_id,
                customerPhoneNumber: '0771049950',
                reason: 'payment for order no ' + this.$page.props.order.id,
            }),

            btnloading: false,
            valid: true,
            loading: false,

            loaderMessage: '',
            retries: 10,

            rules: {
                customerPhoneNumber: [(v) => !!v || 'Phone is required', (v) => (v ? v.length === 10 : false) || 'Phone number must have 10 characters', (v) => /07[1,8,7]\d{7}/.test(v) || 'Please enter a valid Econet or OneMoney number'],
            },
        };
    },

    computed: {
        totalQuantities() {
            return this.$page.props.order.quantities.reduce((total, size) => total + size.quantity, 0);
        },
        totalUSD() {
            return this.$page.props.order.quantities.reduce((total, size) => {
                this.form.amount =  total + this.getPriceForSize(size.size, size.gender, 'usd') * size.quantity;

                return total + this.getPriceForSize(size.size, size.gender, 'usd') * size.quantity;
            }, 0);
        },
    },

    methods: {
        getPriceForSize(size, gender, currency = 'usd') {
            const priceEntry = this.$page.props.prices.find((price) => price.size === size && price.gender === gender);
            if (!priceEntry) return 0;
            return currency === 'usd' ? priceEntry.usd_price : priceEntry.rtgs_price;
        },

        async MakePayment() {
            if (this.form.customerPhoneNumber.length < 10) {
                return;
            }

            this.btnloading = true;
            const response = (await axios.post(route('initiatePayment'), this.form)).data;

            if (response.status === 'error') {
                this.$swal.fire({
                    icon: 'error',
                    title: response.message,
                    text: response.reason,
                });
                return;
            }

            this.loaderMessage = response.message;
            this.loading = true;
            this.btnloading = true;

            console.log(response);

            var poll = new FormData();
            poll.append('ref_num', response.ref_num);

            this.callbackHandler = setInterval(async () => {
                const response = (await axios.post(route('pese-return'), poll)).data;
                if (response.status === 'paid') {
                    return this.markAsPaid(response.ref_num);
                }

                if (this.retries <= 1) {
                    return this.markAsFailed();
                }
                this.retries--;
            }, 2000);

            this.btnloading = false;
        },

        markAsFailed() {
            this.removeCallback();
            this.removeOverlay();
            this.$swal.fire({
                icon: 'info',
                text: 'Transaction timed out while waiting for payment.',
            });
        },

        markAsPaid(id) {
            // Remove interval
            this.removeCallback();
            this.removeOverlay();
            this.$swal.fire({
                icon: 'success',
                title: 'Payment Successful',
                text: 'We have successfully received your payment!. Please save this reference no. ' + id,
            });

            window.location = route('pese-result', id);
        },

        removeCallback() {
            clearInterval(this.callbackHandler);
        },

        removeOverlay() {
            this.loading = false;
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
