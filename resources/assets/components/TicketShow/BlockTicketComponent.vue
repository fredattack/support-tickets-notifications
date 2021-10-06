<template>
  <div class="col-12 col-md-10 offset-md-1 border p-3 pb-6 my-5">
    <!--{{auth.role}}-->
    <div class="row justify-content-end mr-5">
      <div class="btn-group">

        <button type="button" class="btn " :class="status_color" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
       {{ticket.status &&  t(ticket.status) }}
        </button>
        <div class="dropdown-menu " v-if="status !== 'closed' && auth.role === 'super-admin' ">
          <a class="dropdown-item" href="#" @click="setTicketClosed">{{ t('closed') }}</a>
        </div>
      </div>
    </div>
    <h3>{{ ticket.title }}</h3>
    <hr>
    <div class="col-10 offset-1">
      <p>{{ ticket.description }}</p>
    </div>
    <hr>
    <div class="row ">

      <div class="col-4 ">
        <div class="row justify-content-center">

          <h3><span class="badge badge-primary">{{ticket.type &&  t(ticket.type) }}</span></h3>
        </div>
      </div>
      <div class="col-4 ">
        <div class="row justify-content-center">
          <p class="text-muted">{{t('priority')}}: <span v-for=" n in ticket.priority">  <i class="fas fa-exclamation mx-2 "></i> </span>
          </p>
        </div>
      </div>
      <div class="col-4 ">
        <div class="row justify-content-center">
<!--          <p v-if="ticket.author" class="text-muted ">{{t('created_on')}}&nbsp;{{ ticket.created_at }}-->
<!--            <span>&nbsp;{{t('by')}}&nbsp;{{ ticket.author.first_name }}</span></p>-->
        </div>
      </div>
    </div>

    <hr>
    <div class="col-10 offset-1">
      <attachment-list-component :ticket="ticket"/>
    </div>
  </div>
</template>
<script>
import AttachmentListComponent from "./AttachmentListComponent";
import {mapState} from 'vuex'
import {useI18n} from "vue-i18n";

export default {
  name: 'block-ticket-component',
  components: {AttachmentListComponent},
  data() {

    return {
      read: true,
    }
  },
  setup() {
    const {t, locale} = useI18n();
    return {t, locale}
  },
  computed: {
    role(){ return this.$store.auth.role },
    ...mapState(['auth']),
    status() {
      return this.ticket.status
    },
    status_color() {
      if (this.status === 'open') return "btn-primary dropdown-toggle"
      if (this.status === 'closed') return "btn-danger"
      if (this.status === 'in progress') return "btn-warning dropdown-toggle"

    },
  },
  props: {
    ticket: {}
  },
  methods: {
    setTicketClosed() {
      this.$emit('setTicket-closed')
    }
  },
}
</script>
