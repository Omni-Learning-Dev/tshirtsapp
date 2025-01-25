<template>
    <v-app id="inspire">
        <!-- App Bar -->
        <v-app-bar elevation="0" color="black" class="pr-5">
            <InertiaLink class="InertiaLink" :href="route('welcome')">
                <img height="40px" class="ml-2" src="/images/logo-main-white.png" alt="Capital Creatives Logo" />
            </InertiaLink>
            <v-spacer></v-spacer>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('welcome')"> Home </InertiaLink>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('welcome')"> About </InertiaLink>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('welcome')"> How it Works </InertiaLink>
            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('Contact')"> Contact Us</InertiaLink>

            <InertiaLink v-if="$vuetify.display.smAndUp" class="InertiaLinkMenu bebas-neue-regular mx-5" :href="route('login')">
                <span v-if="$page.props.auth.user">My Dashboard</span>
                <span v-else>Login</span>
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
    color: #f7c54a;
    text-decoration: none;
    font-size: 2rem;
    font-weight: 900;
    text-transform: uppercase;
    white-space: nowrap;
}
</style>
