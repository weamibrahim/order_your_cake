<template>
  <nav class="navbar navbar-expand-lg">
    <i class="fa-solid fa-cake-candles mx-3 fs-3 text-secondary"></i>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/dashboard" v-if="userRole === 'admin'">
            Dashboard
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/home">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/profile">Profile</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/products">Products</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/cart">
            <i class="fa-solid fa-basket-shopping" style="color: #bdc4d1;"></i>
          </router-link>
        </li>
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/login">Login</router-link>
        </li>
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/signup">Signup</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-dark fs-3" aria-current="page" to="/signup" @click="logout" v-if="isLoggedIn">Logout</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

export default {
  name: "NavbarApp",
  setup() {
    const router = useRouter();
    const isLoggedIn = ref(false); // Initialize as false
    const userRole = ref("");

    // Check if the user is logged in when the component is mounted
    const checkLoginStatus = () => {
      isLoggedIn.value = localStorage.getItem("accessToken") !== null;
      userRole.value = JSON.parse(localStorage.getItem("userData")).role || "";
    };

    const logout = () => {
      localStorage.removeItem("accessToken");
      localStorage.removeItem("userData");
      router.push("/login");
      isLoggedIn.value = false; // Update the status immediately
    };

    // Check if the user is trying to access the "Dashboard" route and is not an admin
    const checkAdminAccess = (to, from, next) => {
      if (to.path === "/dashboard" && userRole.value !== "admin") {
        next("/home"); // Redirect non-admin users to the "Home" page
      } else {
        next(); // Continue with the navigation
      }
    };

    // Call the function when the component is mounted
    onMounted(() => {
      checkLoginStatus();
    });

    // Register the navigation guard
    router.beforeEach(checkAdminAccess);

    return { logout, isLoggedIn, userRole };
  },
};
</script>

<style scoped>
.ic {
  color: #6aeafe;
}

nav {
  background-color: #f1eef1dc;
}

li:hover {
  color: #ff58ff !important;
}

i {
  color: rgb(228, 141, 221) !important;
}

.navbar-nav {
  margin: 0 auto;
}
</style>
