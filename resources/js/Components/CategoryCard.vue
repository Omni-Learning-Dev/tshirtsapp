<script>
export default {
    props: ['category'],
};
</script>

<template>
    <InertiaLink class="InertiaLink" :href="`/order/` + category.slug">
        <v-card variant="flat" class="pa-2 rounded-lg text-center" color="white" height="180">
            <img width="100px" :src="category.preview_image" class="rounded-lg" />
            <h2>{{ category.name }}</h2>
        </v-card>
    </InertiaLink>
</template>

<style scoped></style>
