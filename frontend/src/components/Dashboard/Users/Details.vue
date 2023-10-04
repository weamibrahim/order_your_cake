<template>
   <div class="d-flex justify-content-center">
   <SidebarApp/>
    <div class="container-fluid bg  ">
    <h1>Info of User</h1>
    <div class="card">
      <div class="card-body">
       
        <h5 class="card-title"> Name: {{ userData.firstName }}</h5>
        <h5 class="card-title"> Email: {{ userData.email }}</h5>
        <h5 class="card-title"> Address: {{ userData.address }}</h5>
        <h5 class="card-title"> Mobile: {{ userData.mobile }}</h5>
     
        <h5 class="card-title"> Role: {{ userData.role }}</h5>
        <button class="btn btn-primary" @click="back">Go to Users</button>
      </div>
    </div>
  </div>

  </div>
</template>

<script>
import  SidebarApp from "./../SideBar.vue";
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

export default {
  name: 'DetailsApp',
    components: {
   SidebarApp
  },
  setup() {
    const id = ref('');
    const name = ref('');
    const email = ref('');
    const address = ref('');
    const mobile = ref('');
   
    const role = ref('');
   

    const route = useRoute();
    const router = useRouter();

    const getUserByID = () => {
      const userId = route.params.id;
      
      axios.get(`http://localhost:8000/api/user/${userId}`)
        .then((res) => {
          const responseData = res.data; // Store response data in a different variable
          id.value = responseData.id;
          name.value = responseData.name;
          email.value = responseData.email;
          address.value = responseData.address;
          mobile.value = responseData.phone;
          
          role.value = responseData.role
    
        })
        .catch((err) => console.error(err));
    };


    onMounted(() => {
      getUserByID();
    });

    const userData = computed(() => ({
      Id: id.value,
      firstName: name.value,
      email: email.value,
      address: address.value,
      mobile: mobile.value,
    
      role: role.value

    }));
   console.log(userData);

    const back = () => {
      router.push('/dashboard/users');
    };

    return {
      userData,
      back,
    };
  },
};
</script>

<style scoped>

</style>
