<template>
    <v-app id="inspire">
        <!-- App Bar -->
        <v-app-bar elevation="0" color="black" class="pr-5">
            <InertiaLink class="InertiaLink" :href="route('welcome')">
                <img height="40px" class="ml-2" src="/images/logo-main-white.png" alt="Capital Creatives Logo" />
            </InertiaLink>
            <v-spacer></v-spacer>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('welcome')"> About Us </InertiaLink>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('welcome')"> How it Works </InertiaLink>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('Contact')"> Contact Us</InertiaLink>
            <InertiaLink
                v-if="$vuetify.display.smAndUp"
                class="InertiaLinkMenu bebas-neue-regular mx-5  "
                style="
                        background-color: #f7c54a;
                        border-radius: 50px;
                        width: 120px;
                        text-align: center;
                        padding: 4px 8px;
                        display: inline-block;
                        text-decoration: none;
                        color: #000;
                        font-weight: 500;
                        text-transform: uppercase;
                        transition: all 0.3s ease;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    "
                         :href="route('Contact')"
            >
                Shop
            </InertiaLink>


            <v-btn v-if="$vuetify.display.smAndDown">
                <v-icon size="30">mdi-menu</v-icon>
            </v-btn>
        </v-app-bar>

        <!-- Main Content -->
        <v-main>
            <slot />
        </v-main>
        <FooterBar />
    </v-app>
</template>

<script setup lang="ts">
import FooterBar from './FooterBar.vue';
</script>

<style scoped>
.InertiaLinkMenu {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.3rem;
    font-weight: 900;
    text-transform: uppercase;
    white-space: nowrap;
}

.InertiaLinkMenu:hover {
    color: #f7c54a !important;
}


</style>
