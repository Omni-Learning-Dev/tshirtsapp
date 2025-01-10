<template>
    <v-app id="inspire">
        <v-app-bar class="glass-shadow">
            <v-app-bar-title>
               Capital Kreatives<br>
               Branding
            </v-app-bar-title>

            <v-spacer></v-spacer>

            <InertiaLink :href="route('login')">
                <v-btn>
                    Login
                </v-btn>
            </InertiaLink>

            <!-- <InertiaLink :href="route('register')">
                <v-btn>
                    Register
                </v-btn>
            </InertiaLink> -->

            <InertiaLink :href="route('register')">
                <b-btn>
                    Home
                </b-btn>

            </InertiaLink>
            
            <InertiaLink :href="route('register')">
                <b-btn>
                    Contact
                </b-btn>
            </InertiaLink>
        </v-app-bar>

        <v-main>
            <v-container>
               <slot/>
            </v-container>
        </v-main>
    </v-app>
</template>
<script setup lang="ts">
</script>
