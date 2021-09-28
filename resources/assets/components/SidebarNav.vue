<template>
  <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
    <div class="list-group mt-5 list-nav">
      <router-link :to="{name:'home'}" class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-list"></i>&nbsp;Tickets List</span>
      </router-link>
      <router-link :to="{name:'new-ticket'}"  class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-plus"></i>&nbsp;New Ticket</span>
      </router-link>
      <router-link :to="{name:'archived'}"  class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-archive"></i>&nbsp;Archived</span>
      </router-link>
      <router-link :to="{name:'features-list'}"  class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-clipboard-list"></i>&nbsp;new features</span>
      </router-link>

    </div>
  </div>
</template>
<script>
export default {
  name: 'sidebar-nav'
}
</script>
