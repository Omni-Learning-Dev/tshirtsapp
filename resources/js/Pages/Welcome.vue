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

                    <v-col
                        cols="6"
                        v-if="$page.props.categories.length > 0"
                        v-for="category in $page.props.categories"
                        :key="ca.id"
                    >
                        <CategoryCard :category="category"/>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import Default from "@/Layouts/Default.vue";
import {ca} from "vuetify/locale";
import CategoryCard from "@/Components/CategoryCard.vue";

export default {
    components: {CategoryCard},
    computed: {
        ca() {
            return ca
        }
    },
    layout:Default
}
</script>
