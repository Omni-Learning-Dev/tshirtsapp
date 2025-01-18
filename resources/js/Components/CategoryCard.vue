<script>
    export default {
        props:['category']
    }
</script>

<template>
    <InertiaLink   class="InertiaLink " :href="`/order/`+category.slug">
       <v-card variant="outlined" class="pa-2" color="primary">
           <v-row class="d-flex align-center  " >
                   <v-col cols="4">
                       <v-img
                           height="100px"
                           width="100px"
                           :src="category.preview_image"
                           cover
                           class="rounded-lg"
                       />
                   </v-col>

                   <v-col cols="8">
                       <h2 class="text-center"> {{ category.name }}</h2>
                       <v-btn block class="mt-3">
                           Order &nbsp;<v-icon>mdi-chevron-double-right</v-icon>
                       </v-btn>
                   </v-col>
               </v-row>
       </v-card>
    </InertiaLink>
</template>

<style scoped>

</style>
