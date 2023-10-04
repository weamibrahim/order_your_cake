<template>
  <div class="d-flex justify-content-center">
    <SidebarAPP />
    <div class="container-fluid bg  ">
   <h1 class='text-center text-white mt-4'>create product</h1>
    <div className='d-flex justify-content-center '>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" >

       <div class="form-group"> 
           <label for="createImage" class="form-label text-dark">Image:</label>
            <input
              type="file"
              class="form-control mb-3"
              id="createImage"
              accept="image/*"
              @change="handleImageChange"
              name="image"
            />
      </div>
      <div class="form-group">
        <label for="createFirstName" class="form-label text-dark">Name:</label>
        <input
          type="text"
          class="form-control mb-3"
          id="createFirstName"
          v-model="formData.name"
        />
      </div>
      <div class="form-group">
        <label for="createdes" class="form-label text-dark">description:</label>
        <input
          type="text"
          class="form-control mb-3"
          id="createdes"
          v-model="formData.description"
        />
      </div>
      <div class="form-group">
        <label for="createcategory" class="form-label text-dark">category</label>
        <input
          type="text"
          class="form-control mb-3"
          id="createcategory"
          v-model="formData.category"
        />
      </div>
      <div class="form-group">
       <label for="createprice" class="form-label text-dark">price</label>
        <input
          type="text"
          class="form-control mb-3"
          id="createprice"
          v-model="formData.price"
        />
      </div>
      <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
    </div>
  </div>
  </div>
</template>

<script>
import {  reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import SidebarAPP from "./../SideBar.vue";
export default {
  name: "CreateProductAPP",
  components: {
   SidebarAPP
  },
  setup() {
    const router = useRouter();
    const formData = reactive({
     name:"",
     category:"",
     price:"",
     description:"",
     image:null, // Add an image property to store the selected image
    });

     const handleImageChange = (event) => {
      // Update the formData with the selected image file
      console.log(event.target.files[0]);
     formData.image = event.target.files[0];
  
      //console.log(formData.image)
    };
  

    const submitForm = () => {
       const form = new FormData();
      form.append("name", formData.name);
      form.append("category", formData.category);
      form.append("price", formData.price);
      form.append("description", formData.description);
      form.append("image", formData.image); // Append the image file
     

       // Debugging: Log the form data
      //console.log("Form Data:", Object.fromEntries(form.entries()));
     
    axios
  .post("http://localhost:8000/api/products", formData, {
    ////////////////very important to creat image
    headers: {
      "Content-Type": "multipart/form-data", // Set content type for file upload
    },
  })
  .then((res) => {
  console.log("Response:", res.data);
    router.push("/dashboard/allproduct");
  })
  .catch((error) => {
    if (error.response) {
      // The request was made and the server responded with a status code
      // that falls out of the range of 2xx
      console.error(error.response.data); // Log the validation errors
    } else if (error.request) {
      // The request was made but no response was received
      console.error(error.request);
    } else {
      // Something happened in setting up the request that triggered an Error
      console.error("Error", error.message);
    }
  });
    };


    return {
      formData,
      submitForm,
      handleImageChange
   
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