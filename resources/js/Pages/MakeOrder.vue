<template>
    <Default>
      <v-container class="mt-5">
          <v-row>
              <v-col cols="12" sm="5">
                  {{ $page.props.category }}
              </v-col>
              <v-col cols="12" sm="7">
                   <v-card>
                       <v-card-title>
                           Make Order Form
                       </v-card-title>
                   </v-card>
              </v-col>
          </v-row>
      </v-container>
    </Default>
</template>
<script setup>

import Default from "@/Layouts/Default.vue";

</script>
