<script>
    export default {
        props:['category']
    }
</script>

<template>
    <InertiaLink   class="InertiaLink " :href="`/order/`+category.slug">
       <v-card variant="outlined" class="pa-2" color="grey-darken-3" min-height="150">
           <v-row class="d-flex align-center  " >
                   <v-col cols="4">
                       <v-img
                           height="130px"
                           width="130px"
                           :src="category.preview_image"

                           class="rounded-lg border"
                       />
                   </v-col>

                   <v-col cols="8">
                      <v-card variant="text" color="grey-darken-3">
                          <h2 > {{ category.name }}</h2>
                          <p>{{ category.description }}</p>

                          <v-card-actions>
                              <v-spacer/>
                              <v-icon color="primary" size="30">
                                  mdi-chevron-right
                              </v-icon>
                          </v-card-actions>
                      </v-card>
                   </v-col>
               </v-row>
       </v-card>
    </InertiaLink>
</template>

<style scoped>

</style>
