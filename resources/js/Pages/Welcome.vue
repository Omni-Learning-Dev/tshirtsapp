<template>
    <Default>
        <v-container class="mb-10 mt-n2" fluid>
            <v-row class="d-flex hero-section">
                <v-col cols="12" sm="6" class="image-container">
                    <v-img
                        src="/images/Man-Edied-1.png"
                        contain
                        class="man-image"
                         height="90vh"
                    />
                </v-col>

                <v-col cols="12" sm="5" class="d-flex flex-column">
                    <v-row no-gutters>
                        <template v-for="(category, index) in $page.props.categories">
                            <!-- First 4 categories in the first row -->
                            <v-col
                                v-if="index < 4"
                                :key="category.id"
                                cols="6" sm="6" md="3" lg="3"
                            >
                                <CategoryCard :category="category" />
                            </v-col>
                        </template>
                    </v-row>
                    <v-row no-gutters>
                        <!-- Second row: Show the rest of the categories -->
                        <template v-for="(category, index) in $page.props.categories">
                            <!-- Categories after the first 4 go in the second row -->
                            <v-col
                                v-if="index >= 4"
                                :key="category.id"
                                cols="6" sm="6" md="3" lg="3"
                            >
                                <CategoryCard :category="category" />
                            </v-col>
                        </template>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </Default>
</template>

<script setup>
import CategoryCard from '@/Components/CategoryCard.vue';
import Default from '@/Layouts/Default.vue';
import { useDisplay } from 'vuetify';

const { xs, mdAndUp } = useDisplay();
</script>

<style scoped>
.hero-section {
    opacity: 1;
    background-color: transparent;
    background-image: url('/images/Main-Logo-Fade_00000.png'), linear-gradient(154.94deg, #113559, #008f9b);
    background-position: -30%, 0 0;
    background-repeat: no-repeat, repeat;
    background-size: 70rem, auto;
    background-attachment: fixed, scroll;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

</style>
