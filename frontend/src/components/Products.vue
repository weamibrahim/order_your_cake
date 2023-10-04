<template>
<div >
  <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img  src="https://img.freepik.com/premium-photo/birthday-cake-with-candles-balloons-purple-background_49280-278.jpg?size=626&ext=jpg&uid=R50739859&ga=GA1.1.1532466403.1676939380&semt=sph" class="d-block w-100 imgslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/free-photo/sweet-table-feast-flowers-multicolored-macaroons_501050-555.jpg?size=626&ext=jpg&uid=R50739859&ga=GA1.2.1532466403.1676939380&semt=sph" class="d-block w-100 imgslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/free-photo/bottom-view-cake-with-cream-purple-shawl-grey-table_140725-146096.jpg?size=626&ext=jpg&uid=R50739859&ga=GA1.2.1532466403.1676939380&semt=sph" class="d-block w-100 imgslide" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

  <div class="my-5 d-flex justify-content-center">
      <input type="text" v-model="searchText" class="form-control " placeholder="Search by  Name or category or price ">
  
  

    </div>
    <div class="container">
<div  class="row row-cols-1 row-cols-md-3 g-4 my-3" >
  <div class="col" v-for="product in filteredProducts" :key="product.id">
    <div class="card border-3" style="border-radius: 15px">
    <router-link :to="`product/${product.id}`">  <img class="rounded-4 image" :src="'http://localhost:8000/images/'+product.image" alt="...">
    </router-link>
      <div class="card-body">
       <h5 class="card-title text-center" style=" font-family: 'sofia';">{{product.name}}</h5>
        <p class="card-text text-center" style=" font-size: 20px ;">{{product.price}}</p>
         <p class="card-text text-center" >{{product.category}}</p>
      </div>
    </div>
  </div>
  
 
  
</div>
    </div>
</div>
</template>

<script>

import {ref,onMounted,computed} from "vue";
import axios from 'axios';
export default {
 name: 'ProductsApp',


 setup(){
  const products = ref([])
  const searchText = ref("");
  const getallproducts = () => {
      axios.get("http://localhost:8000/api/products")
        .then((res) => {
         console.log(res.data);
          products.value = res.data;
        })
        .catch((err) => console.log(err));
    };

  const filteredProducts = computed(() => {
      return products.value.filter((product) => {
        const allcategory = `${product.name} ${product.category} ${product.price}`;
        return allcategory.toLowerCase().includes(searchText.value.toLowerCase());
      });
    });


  

  onMounted(()=>{
    getallproducts();
 })

  return{
    products,
    
      filteredProducts,
      searchText
  }
 }

}
</script>


<style scoped>
.image{
  width: 415px;
  height: 300px;

}
input{
  width: 400px;
  border: 3px solid #f1a6e9;
}
.imgslide{
  height: 80vh;
}
</style>
