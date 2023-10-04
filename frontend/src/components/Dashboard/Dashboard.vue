<template>
  
  <div >
      <div className="d-flex justify-content-center">
      <SidebarAPP/>
        
              
        <div className="container-fluid bg"><div className="overlay">
                <h2>Welcome to DashBoard</h2>
              </div></div>
       
      </div>
    </div>



</template>

<script>
import SidebarAPP from "./SideBar.vue"
export default {
name:"DashboardApp",
components: {
   SidebarAPP
  }
}

</script>

<style >
/* Default styles */
.bg {
  background-image: url("https://img.freepik.com/free-photo/birthday-cake-teddy-bear-vintage-suitecase-balloons-isolated-white-background_8353-6228.jpg?w=1060&t=st=1696006008~exp=1696006608~hmac=81ae71b4a6a63709c0fd7fe789873d7ee60ab1b65a14000c3763ca429afc203d");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  height: 100vh; /* Ensure full viewport height */
  position: relative; /* Needed for overlay positioning */
}

.overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(255, 255, 255, 0.658);
  padding: 20px;
  border-radius: 5px;
  text-align: center; /* Center-align the content */
}
.overlay h2 {
  margin: 0; /* Remove default margin */
}

/* Media queries */
@media (max-width: 768px) {
  /* Adjust overlay for smaller screens */
  .overlay {
    font-size: 14px;
    padding: 10px;
  }
  
  /* ... (other styles) */
}

</style>