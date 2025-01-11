<template>
  <v-app id="inspire">
    <!-- App Bar -->
    <v-app-bar class=" " elevation="0" app>
        <InertiaLink class="InertiaLink" :href="route('welcome')">
            <img height="50px" class="ml-2" src="/images/logo-main.png" alt="Capital Creatives Logo">
        </InertiaLink>
      <v-spacer></v-spacer>

      <InertiaLink class="InertiaLinkMenu mx-1" :href="route('welcome')">
        <v-btn variant="text" color="primary">
          Home
        </v-btn>
      </InertiaLink>


      <InertiaLink class="InertiaLinkMenu mx-1" :href="route('Contact')">
        <v-btn variant="text" color="primary" >
          Contact
        </v-btn>
      </InertiaLink>
    </v-app-bar>

    <!-- Main Content -->
    <v-main>
        <slot />
    </v-main>
      <FooterBar/>
  </v-app>
</template>

<script setup lang="ts">
import FooterBar from "./FooterBar.vue";
</script>

<style scoped>
.InertiaLinkMenu{

}
</style>
