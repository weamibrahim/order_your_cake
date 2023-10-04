<template>
  <div>
  


    <div class="app-container">
      <div class="sidebar">
        <div class="sidebar-header">
          <div class="app-icon">
            Dashboard
          </div>
        </div>
        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
               <RouterLink to="/dashboard" class="text-decoration-none text-black fs-5">
          HOME
        </RouterLink>
            </a>
          </li>
          <li class="sidebar-list-item active">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
             <RouterLink to="/dashboard/allproduct" className="text-decoration-none text-black fs-5 ">
          products
        </RouterLink>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                <RouterLink to="/dashboard/users" className="text-decoration-none text-black fs-5 ">
          users
        </RouterLink>
            </a>
          </li>
         
        </ul>
      </div>
    </div>
   
    </div>
</template>

<script>
export default {
name:"SidebarApp"
}



</script>

<style scoped> 
.sidebar{
  width: 200px;
}
  
  
  
  
  
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap");
* {
  box-sizing: border-box;
}



body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}

body {
  overflow: hidden;
  font-family: "Poppins", sans-serif;
  background-color: var(--app-bg);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.app-container {
  border-radius: 4px;
  width: 100%;
  height: 100%;
  max-height: 100%;
  display: flex;
  overflow: hidden;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  max-width: 2000px;
  margin: 0 auto;
}

.sidebar {
  flex-basis: 200px;
  max-width: 200px;
  flex-shrink: 0;
  background-color: rgba(253, 211, 255, 0);
  display: flex;
  flex-direction: column;
}
.sidebar-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px;
}
.sidebar-list {
  list-style-type: none;
  padding: 0;
}
.sidebar-list-item {
  position: relative;
  margin-bottom: 4px;
}

.sidebar-list-item a {
  display: flex;
  align-items: center;
  width: 100%;
  padding: 10px 16px;
  color: black;
  text-decoration: none;
  font-size: 14px;
  line-height: 24px;
}
.sidebar-list-item svg {
  margin-right: 8px;
}
.sidebar-list-item:hover {
  background-color: rgb(242, 136, 231);
}
.sidebar-list-item.active {
  background-color: rgb(231, 196, 230);
}
.sidebar-list-item.active:before {
  content: "";
  position: absolute;
  right: 0;
  background-color:rgb(237, 237, 237);
  height: 100%;
  width: 4px;
}
@media screen and (max-width: 1024px) {
  .sidebar {
    display: none;
  }
}

</style>