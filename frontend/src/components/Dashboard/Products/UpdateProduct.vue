<template>
<div class="d-flex justify-content-center">
    <SidebarAPP />
    <div class="container-fluid bg">
    
  <h1 class="text-center text-white mt-4">Edit product</h1>
   <div className='d-flex justify-content-center '>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" >

      <!-- <div class="form-group">
     <label for="updateImage" class="form-label text-white">Image:</label>
            <input
              type="file"
              class="form-control mb-3"
              id="updateImage"
              accept="image/*"
              @change="handleImageChange"
              name="image"
              
            />
      
      </div> -->
    <div class="form-group">
        <label for="createFirstName" class="form-label text-white">Name:</label>
        <input
          type="text"
          class="form-control mb-4"
          id="createFirstName"
          v-model="formData.name"
        />
      </div>
       <div class="form-group">
        <label for="createdes" class="form-label text-white">description:</label>
        <input
          type="text"
          class="form-control mb-3"
          id="createdes"
          v-model="formData.description"
        />
      </div>
      <div class="form-group">
        <label for="createcategory" class="form-label text-white">category</label>
        <input
          type="text"
          class="form-control mb-4"
          id="createcategory"
          v-model="formData.category"
        />
      </div>
      <div class="form-group">
       <label for="createprice" class="form-label text-white">price</label>
        <input
          type="number"
          class="form-control mb-4"
          id="createprice"
          v-model="formData.price"
        />
      </div>
       <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary mx-4">Save</button>
      <button @click="cancelEdit" class="btn btn-secondary">Cancel</button>
       </div></form>
   </div>
  </div>
  </div>
</template>

<script>
import { ref, reactive } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import SidebarAPP from "./../SideBar.vue";

export default {
  name: "UpdateProductApp",
  components: {
    SidebarAPP,
  },
  setup() {
    const router = useRouter();
    const route = useRoute();
    const productId = ref('');
    // const selectedImage = ref(null);
    const formData = reactive({
      name: "",
      category: "",
      price: "",
      description: "",
      //image: null,
    });

    // const handleImageChange = (event) => {
    //   const file = event.target.files[0];
    //     selectedImage.value = file;
    // formData.image = file;
       
 
    // };

    const getproductData = () => {
      productId.value = route.params.id;

      axios
        .get(`http://localhost:8000/api/products/${productId.value}`)
        .then((res) => {
          const { name, category, price, description} = res.data;
          formData.name = name;
          formData.price = price;
          formData.category = category;
          formData.description = description;
          // formData.image = image;
        })
        .catch((err) => console.error(err));
    };

   const submitForm = () => {
  const form = new FormData();
  form.append("name", formData.name);
  form.append("category", formData.category);
  form.append("price", formData.price);
  form.append("description", formData.description);
  //form.append("image", formData.image);

  // Check if a new image is selected and append it
  // if (selectedImage.value) {
  //   form.append("image", selectedImage.value);
  // } else {
  //   // If no new image is selected, you can append the existing image data
  //   form.append("image", formData.image);
  // }

  // console.log(formData);

  // Send the updated data to the server as a multipart/form-data request
  axios
    .put(`http://localhost:8000/api/products/${productId.value}`, formData
    )
    .then((res) => {
      // Update formData with the response data
   
      console.log("response", res);
      router.push(`/dashboard/allproduct`);
    })
    .catch((err) => {
      console.error(err);
      // Add code to handle errors, e.g., show an error message to the user
    });
};


    const cancelEdit = () => {
      router.push(`/dashboard/allproduct`);
    };

    // Load product data on component mount
    getproductData();

    return {
      formData,
      submitForm,
      cancelEdit,
      //handleImageChange,
    };
  },
};
</script>
<style scoped>


form{
  max-width: 900px;
  margin-top: 50px;
}


input{
  width: 800px
}
</style>