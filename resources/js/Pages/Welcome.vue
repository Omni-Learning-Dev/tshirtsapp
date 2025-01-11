<template>
    <v-container class="my-10" fluid>
        <v-row>
            <v-col cols="12" sm="6">
                <v-carousel class="rounded-lg" cycle :show-arrows="false" hide-delimiter-background>
                    <v-carousel-item
                        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                        cover
                    ></v-carousel-item>

                    <v-carousel-item
                        src="https://cdn.vuetifyjs.com/images/cards/hotel.jpg"
                        cover
                    ></v-carousel-item>

                    <v-carousel-item
                        src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                        cover
                    ></v-carousel-item>
                </v-carousel>
            </v-col>
            <v-col cols="12" sm="6">
                <v-row class="glass">
                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>


                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="6">
                        <v-card color="primary">
                            <v-card-text>
                                Vests
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import Default from "@/Layouts/Default.vue";

export default {
    layout:Default
}
</script>
