<template>
    <!-- <v-row> -->
        <!-- <v-col
            v-for="n in 24"
            :key="n"
            cols="4"
        > -->
            <!-- <v-card class="glass" height="200"></v-card>
        </v-col>
    </v-row> -->
    <div class="welcome-container">
        <div class="left-panel">
            <h2>Welcome to Our Store</h2>
            <p>Discover the best T-shirts for your style.</p>
            <img src="path-to-image/hero-tshirt.jpg" alt="Featured T-shirt" class="hero-image" />
            <button>Shop Now</button>
        </div>
        
        <div class="right-panel">
            <h2>Explore Our Categories</h2>
            <div class="card-row" v-for="(category, index) in categories" :key="index">
                <div class="card">
                    <img :src="category.image" :alt="category.title" class="card-image" />
                    <h3 class="card-title">{{ category.title }}</h3>
                    <p class="card-description">{{ category.description }}</p>
                </div>
                <div v-if="(index + 1) % 2 === 0" class="spacer"></div>
            </div>
        </div>
    
    </div>



</template>

<script>
import Default from "@/Layouts/Default.vue";

export default {
    layout:Default,
    data(){
        return{
            categories:[
                {
                    image: 'path-to-image/tshirt1.jpg',
                    title: 'T-shirts',
                    description: 'Explore our collection of T-shirts',
                },
                {
                    image: 'path-to-image/hoodie1.jpg',
                    title: 'Hoodies',
                    description: 'Stay cozy with our latest hoodie collection', 
                },
                {
                    image: 'path-to-image/jackets1.jpg',
                    title: 'Jackets',
                    description: 'Shop stylish jackets for all seasons',

                }
            ]
        }
    }
}
</script>
<style>
.welcome-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 20px;
}

/* Left Panel (cards) */
.left-panel {
  width: 30%;
  padding: 20px;
  background-color: #f8f8f8;
}

.left-panel h2 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
}

.card {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
  padding: 15px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  /* Add some spacing between the cards */
  margin-bottom: 25px;
}
.card-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.card-row {
    flex-direction: column; /* Stack cards vertically on smaller screens */
  }


.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.card-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.card-title {
  font-size: 18px;
  margin-top: 10px;
  color: #333;
}

.card-description {
  color: #555;
  text-align: center;
  margin-top: 5px;
  font-size: 14px;
}

/* Right Panel (T-shirt image) */
.right-panel {
  width: 65%;
  padding: 20px;
  text-align: center;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.right-panel h2 {
  font-size: 32px;
  margin-bottom: 20px;
  color: #333;
}

.right-panel p {
  font-size: 18px;
  color: #555;
  margin-bottom: 20px;
}

.right-panel img {
  max-width: 80%;
  border-radius: 8px;
}

.left-panel button {
  background-color: #ff5722;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.right-panel button:hover {
  background-color: #e64a19;
}

/* Responsive Design */
@media (max-width: 768px) {
  .welcome-container {
    flex-direction: column;
}
.left-panel, .right-panel {
    width: 100%;
}
}
</style>
