
<template>

     <div className="d-flex justify-content-center">
      <title>mmmmm</title>
      <SidebarAPP/>
    <!-- Add a search input field -->
     <div class="container-fluid bg">      <div class="mb-3 my-3">
      <input type="text" v-model="searchText" class="form-control" placeholder="Search by  Name or price or category ">
    
    </div>
    <button class="btn btn-success my-2" >  <router-link class="text-decoration-none text-white"  to="createproduct">create </router-link> </button>
    <table >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">image</th>
          <th scope="col">name</th>
          <th scope="col">price</th>
          <th scope="col">category</th>
          
          <th scope="col">delete</th>
          <!-- <th scope="col">view</th> -->
          <th scope="col">update</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product,index) in filteredproducts" :key="product.id" >
          
          <th scope="row">{{ index+1}}</th>
       <td><img v-if="product.image" :src="'http://localhost:8000/images/'+product.image" alt=""  class="rounded-circle"></td>
          <td>{{ product.name }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.category }}</td>
          
          <td><button class="btn btn-danger" @click="deleteproduct(product.id)">Delete</button></td>
          <!-- <td><button class="btn btn-info"> <router-link class="btn" :to="`/products/${product.id}`">show </router-link></button></td> -->
          <td><button class="btn btn-primary"><router-link     class="text-decoration-none text-white"            :to="`updateproduct/${product.id}`">update</router-link></button></td>
          
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
import { ref, onMounted ,computed} from "vue";
import axios from "axios";
import SidebarAPP from "../SideBar.vue"
export default {
  name: 'AllProductApp',
  components:{
    SidebarAPP

  },

  setup() {
    const products = ref([]);
    const searchText = ref("");
    const getallproducts = () => {
      axios.get("http://localhost:8000/api/products")
        .then((res) => {
          console.log(res.data);
          products.value = res.data;

        })

        .catch((err) => console.log(err));
    };
    const deleteproduct = (id) => {
      axios.delete(`http://localhost:8000/api/products/${id}`)
        .then((res) => {
          console.log(res.data);
          getallproducts();
        })
        .catch((err) => console.log(err));
    };
     // Function to filter products based on the search text
    const filteredproducts = computed(() => {
      return products.value.filter((product) => {
        const fullName = `${product.name} ${product.category} ${product.price}`;
        return fullName.toLowerCase().includes(searchText.value.toLowerCase());
      });
    });


    
    onMounted(() => {
      getallproducts();
      
    });

    return {
      products,
      deleteproduct,
       searchText,
      filteredproducts
    };
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>



input{
  width: 300px;
}
img{
  width: 100px;
  height: 100px;
}
table tbody tr {
  background-color: rgba(252, 252, 252, 0) !important; 
 /* Set the background color for table rows to white */
}
table{
  width: 100%;
  margin-bottom: 1rem;

 
  /* Set the background color for table rows to white */
}


/* Style for table header row */
table thead tr {
  background-color: #f7a1ff; 
  height: 40px;
}
</style>
