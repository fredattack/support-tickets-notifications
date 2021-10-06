<template>

  <nav class="navbarcol-12 col-md-3 col-xl-2  bd-sidebar navbar-expand-lg">
    <div class="list-group mt-5 list-nav">
      <router-link :to="{name:'home'}" class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-list"></i>&nbsp;{{ t('ticket_list')}}</span>
      </router-link>
      <router-link :to="{name:'new-ticket'}" class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-plus"></i>&nbsp;{{ t('new_ticket')}}</span>
      </router-link>
      <router-link :to="{name:'archived'}" class="list-group-item">
        <span class="hidden-sm-down text-dark"><i class="fa fa-archive"></i>&nbsp;{{ t('archived')}}</span>
      </router-link>
<!--      <router-link :to="{name:'features-list'}" class="list-group-item">-->
<!--        <span class="hidden-sm-down text-dark"><i class="fa fa-clipboard-list"></i>&nbsp;{{ t('new_function')}}</span>-->
<!--      </router-link>-->

    </div>
  </nav>
</template>
<script>

import {useI18n} from "vue-i18n"


export default {

  name: 'sidebar-nav',
  setup() {
    const {t, locale} = useI18n();
    return {t, locale}
  },
}
</script>
