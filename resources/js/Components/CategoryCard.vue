<template>
    <InertiaLink class="InertiaLink" :href="`/order/` + category.slug">
        <div class="custom-card" :style="cardContainerStyle">
            <div class="card-content">
                <h2 class="card-title bebas-neue-regular">{{ category.name }}</h2>
                <p class="card-description">
                    Available as plain<br>
                    Available with customized<br>
                    branding
                </p>
            </div>

            <div class="product-image-container">
                <img :src="category.preview_image" class="product-image" alt="" />
            </div>
        </div>
    </InertiaLink>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
});

// Define specific color mappings for categories by name/slug
const colorMap = {
    't-shirts': { base: '#00a86b', gradient: 'linear-gradient(to bottom, #00a86b, #006a44)' },
    'vests': { base: '#113559', gradient: 'linear-gradient(to bottom, #113559, #051a2d)' },
    'jackets': { base: '#008f9b', gradient: 'linear-gradient(to bottom, #008f9b, #005a62)' },
    'caps': { base: '#f7c54a', gradient: 'linear-gradient(to bottom, #f7c54a, #d9a428)' },
    'hoodies': { base: '#a9a9a9', gradient: 'linear-gradient(to bottom, #a9a9a9, #777777)' },
    'golf-t-shirts': { base: '#5a5a5a', gradient: 'linear-gradient(to bottom, #5a5a5a, #333333)' }
};

// Compute the gradient based on the category
const cardContainerStyle = computed(() => {
    const categorySlug = props.category.slug || '';
    const colorConfig = colorMap[categorySlug] || {
        base: props.category.bgcolor || '#00a86b',
        gradient: `linear-gradient(to bottom, ${props.category.bgcolor || '#00a86b'}, ${adjustBrightness(props.category.bgcolor || '#00a86b', -30)})`
    };

    return {
        background: colorConfig.gradient,
    };
});

// Function to darken a color by a percentage
function adjustBrightness(hex, percent) {
    hex = hex.replace(/^\s*#|\s*$/g, '');

    if(hex.length === 3) {
        hex = hex.replace(/(.)/g, '$1$1');
    }

    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);

    return '#' +
        ((0 | (1 << 8) + r + (r * percent / 100)).toString(16)).substr(1) +
        ((0 | (1 << 8) + g + (g * percent / 100)).toString(16)).substr(1) +
        ((0 | (1 << 8) + b + (b * percent / 100)).toString(16)).substr(1);
}
</script>

<style scoped>
.InertiaLink {
    text-decoration: none;
    display: block;
}

.custom-card {
    display: flex;
    flex-direction: column;
    border-top-left-radius: 32px;
    border-bottom-right-radius: 32px;
    border-top-right-radius: 60px;
    border-bottom-left-radius: 60px;
    height: 302px;
    position: relative;
    overflow: hidden;
    padding: 20px;
    margin-right: 16px;
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.custom-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.card-content {
    z-index: 2;
    position: relative;
}

.card-title {
    color: white;
    font-size: 28px;
    text-transform: uppercase;
    margin-bottom: 8px;
    line-height: 1;
    letter-spacing: 1px;
}

.card-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 12px;
    line-height: 1.3;
}

.product-image-container {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    z-index: 1;
}

.product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.custom-card:hover .product-image {
    transform: scale(1.05);
}

/* Apply specific styling based on category */
.custom-card[style*="00a86b"] .product-image {
    /* T-shirts specific styling */
    max-height: 80%;
}

.custom-card[style*="113559"] .product-image {
    /* Vests specific styling */
    max-height: 90%;
}

.custom-card[style*="008f9b"] .product-image {
    /* Jackets specific styling */
    max-height: 85%;
}

.custom-card[style*="f7c54a"] .product-image {
    /* Caps specific styling */
    max-height: 70%;
}

/* Responsive adjustments */
@media (max-width: 960px) {
    .custom-card {
        height: 260px;
    }

    .card-title {
        font-size: 24px;
    }
}

@media (max-width: 600px) {
    .custom-card {
        margin-right: 0;
    }
}
</style>
