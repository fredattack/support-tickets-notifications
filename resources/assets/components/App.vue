<template>
<section>


  <header class="bd-navbar">
<div class="row pl-5">
  <img class="img-fluid ml-5 mt-2" width="125" src="http://localhost:8081/vendor/support-tickets-notifications/ADDF_Final_white.png" alt="logo">
</div>


  </header>
  <div class="container-fluid ">
    <div class="row flex-xl-nowrap">
      <sidebar-nav/>

      <div class="col-12 col-md-9 col-xl-10">
        <router-view />
      </div>
    </div>
  </div>
</section>
</template>

<script>
import SidebarNav from "./SidebarNav";


export default {
  name: 'App',
  components: {SidebarNav}
};
</script>
