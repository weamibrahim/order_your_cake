<template>
   <div class="d-flex justify-content-center">
    <SidebarApp />
    <div class="container-fluid bg  ">
   
    <!-- Add a search input field -->
    <div class="mb-3 my-3">
      <input type="text" v-model="searchText" class="form-control" placeholder="Search by Name or email or address">
      
    </div>
                                              
    <table >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">email</th>
          <th scope="col">address</th>
          <th scope="col">delete</th>
          <th scope="col">view</th>
          <th scope="col">update</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in filteredUsers" :key="user.id" >
          
          <th scope="row">{{ index+1 }}</th>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.address}}</td>

          <td><button class="btn btn-danger my-3" @click="deleteUser(user.id)">Delete</button></td>
          <td><button class="btn btn-info"> <router-link class="text-decoration-none text-white" :to="`users/${user.id}`">show </router-link></button></td>
          <td><button class="btn btn-primary"><router-link  class="text-decoration-none text-white"                :to="`update/${user.id}`">update</router-link></button></td>
          
        </tr>
      </tbody>
    </table>
  </div>
   </div>
</template>

<script>
import SidebarApp from "./../SideBar.vue"
import { ref, onMounted ,computed} from "vue";
import axios from "axios";

export default {
  name: 'UsersApp',
    components: {
   SidebarApp
  },

  setup() {
    const users = ref([]);
    const searchText = ref("");
    const getallusers = () => {
      axios.get("http://localhost:8000/api/users")
        .then((res) => {
         // console.log(res.data);
          users.value = res.data;
        })
        .catch((err) => console.log(err));
    };
    const deleteUser = (id) => {
      axios.delete(`http://localhost:8000/api/user/delete/${id}`)
        .then((res) => {
          console.log(res.data);
          getallusers();
        })
        .catch((err) => console.log(err));
    };
     // Function to filter users based on the search text
    const filteredUsers = computed(() => {
      return users.value.filter((user) => {
        const fullName = `${user.user_name} ${user.email} ${user.address}`;
        return fullName.toLowerCase().includes(searchText.value.toLowerCase());
      });
    });


   
    onMounted(() => {
      getallusers();
      
    });

    return {
      users,
      deleteUser,
       searchText,
      
      filteredUsers
    };
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>



input{
  width: 300px;
}
table tbody tr {
  background-color: rgba(252, 252, 252, 0) !important; 
 /* Set the background color for table rows to white */
}
table{
  width: 100%;
  margin-bottom: 1rem;
  vertical-align: top;
 
  /* Set the background color for table rows to white */
}


/* Style for table header row */
table thead tr {
  background-color: #f7a1ff; 
  height: 40px;
  
}
table thead td {
  background-color: #f7a1ff; 
  height: 40px;
 
}

</style>
