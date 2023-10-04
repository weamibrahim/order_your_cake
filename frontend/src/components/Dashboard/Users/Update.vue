<template>
 <div class="d-flex justify-content-center">
    <SidebarApp />
    <div class="container-fluid bg  ">
    <h1 class="text-center text-white mt-4">Edit User</h1>
     <div className='d-flex justify-content-center '>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="editFirstName"  class="form-label text-dark"> Name:</label>
        <input
          type="text"
          class="form-control"
          id="editFirstName"
          v-model="formData.name"
        />
      </div>
      <div class="form-group">
        <label for="editEmail"  class="form-label text-dark">Email:</label>
        <input
          type="email"
          class="form-control"
          id="editEmail"
          v-model="formData.email"
        />
      </div>
      <div class="form-group">
        <label for="editAddress" class="form-label text-dark">Address:</label>
        <input
          type="text"
          class="form-control"
          id="editAddress"
          v-model="formData.address"
        />
      </div>
      <div class="form-group">
        <label for="editphone" class="form-label text-dark">phone:</label>
        <input
          type="text"
          class="form-control"
          id="editphone"
          v-model="formData.phone"

        />
      </div>
      <div class="form-group">
        <label for="editRole" class="form-label text-dark">Role:</label>
        <select v-model="formData.role" class="form-control" required>
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
      </div>
      

      <div  class="d-flex justify-content-center m-3">
      <button type="submit" class="btn btn-primary  mx-2">Save</button>
      <button @click="cancelEdit" class="btn btn-secondary">Cancel</button>
      </div>
    </form>
     </div>
  </div>
 </div>
</template>

<script>
import SidebarApp from "./../SideBar.vue";
import { ref, reactive } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";

export default {
  name: "UpdateUser",
    components: {
   SidebarApp
  },
  setup() {
    const router = useRouter();
     const route = useRoute(); 
    const userId = ref(''); // Define userId as a ref

    const formData = reactive({
     name: ref(''),
     email: ref(''),
     address: ref(''),
     phone: ref(''),
    
     role: ref(''),


    });

    const getUserData = () => {
         userId.value = route.params.id;
      console.log(userId.value)
      axios
        .get(`http://localhost:8000/api/user/${userId.value}`)
        .then((res) => {
          const {name,email,address,phone,role} = res.data;
          formData.name = name;
          formData.email = email;
          formData.address = address;
          formData.phone = phone;
          
          formData.role = role
        })
        .catch((err) => console.error(err));
    };

    const submitForm = () => {
      // Send the updated data to the server
      axios
        .put(`http://localhost:8000/api/user/update/${userId.value}`, {
          name: formData.name,
          email: formData.email,
          address: formData.address,
          phone: formData.phone,
          
          role: formData.role
        })
        .then(() => {
          router.push(`/dashboard/users`);
        })
        .catch((err) => console.error(err));
    };

    const cancelEdit = () => {
      router.push(`/dashboard/users`);
    };

  

    // Load user data on component mount
    getUserData();

    return {
      formData,
      submitForm,
      cancelEdit,
    };
  },
};
</script>
<style scoped>


form{
  width: 900px;
}
input,select{
  width: 800px
}

</style>
