<template>
  <v-app id="inspire">
    <!-- App Bar -->
    <v-app-bar class="glass-shadow">
      <v-app-bar-title class="title-text">
        Capital Kreatives<br>
        Branding
      </v-app-bar-title>

      <v-spacer></v-spacer>

      <!-- Login Link -->
      <InertiaLink :href="route('login')">
        <v-btn class="btn-login" elevation="2">
          Login
        </v-btn>
      </InertiaLink>

      <!-- Home Link -->
      <InertiaLink :href="route('register')">
        <v-btn class="btn-home" elevation="2">
          Home
        </v-btn>
      </InertiaLink>

      <!-- Contact Link -->
      <InertiaLink :href="route('Contact')">
        <v-btn class="btn-contact" elevation="2">
          Contact
        </v-btn>
      </InertiaLink>
    </v-app-bar>

    <!-- Main Content -->
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup lang="ts">
</script>

<style scoped>


/* Styling the App Bar */
.glass-shadow {
  background: rgba(255, 255, 255, 0.8); 
  backdrop-filter: blur(10px); 
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

/* Title text in the App Bar */
.title-text {
  color: #2c3e50; 
  font-size: 24px;
  font-weight: 700;
}

/* Buttons */
.v-btn {
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.3s ease;
  margin-left: 10px;
}

/* Login Button */
.btn-login {
  background-color: #ff5722; 
  color: white;
  border-radius: 4px;
}

.btn-login:hover {
  background-color: #e64a19; 
  transform: scale(1.05); 
}

/* Home Button */
.btn-home {
  background-color: #00bcd4; 
  color: white;
  border-radius: 4px;
}

.btn-home:hover {
  background-color: #0097a7; 
  transform: scale(1.05);
}

/* Contact Button */
.btn-contact {
  background-color: #4caf50; 
  color: white;
  border-radius: 4px;
}

.btn-contact:hover {
  background-color: #388e3c; 
  transform: scale(1.05);
}

/* Main Container */
.v-container {
  background: #f9f9f9;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

/* Text and Content Styling */
h1, h2, h3, p {
  color: #333; 
}

</style>
