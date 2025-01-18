<template>
    <Default>
        <v-container class="mb-10 mt-5" fluid>
            <v-row>
                <v-col cols="12" sm="6">
                    <v-carousel   :height="mdAndUp ? 500 : 250"  cycle :show-arrows="false" >
                        <v-carousel-item
                            src="/images/golf.png"
                            contain
                        ></v-carousel-item>

                        <v-carousel-item
                            src="/images/t-shirt-template.png"
                            contain
                        ></v-carousel-item>

                        <v-carousel-item
                            src="/images/cap.png"
                            contain
                        ></v-carousel-item>

                        <v-carousel-item
                            src="/images/red-sweatshirt.avif"
                            contain
                        ></v-carousel-item>
                    </v-carousel>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-row class="glass">
                        <v-col
                            cols="12"
                            md="6"
                            v-if="$page.props.categories.length > 0"
                            v-for="category in $page.props.categories"
                            :key="category.id"
                        >
                            <CategoryCard :category="category"/>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </Default>
</template>
<script setup>

import CategoryCard from "@/Components/CategoryCard.vue";
import Default from "@/Layouts/Default.vue";
import { useDisplay } from 'vuetify'
const { xs, mdAndUp } = useDisplay()
</script>
