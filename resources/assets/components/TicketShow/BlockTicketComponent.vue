<template>
  <div class="col-12 col-md-10 offset-md-1 border p-3 pb-6 my-5">

    <div class="row justify-content-end mr-5" >
      <div class="btn-group">
        <button type="button" class="btn " :class="status_color" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          {{ticket.status}}
        </button>
        <div class="dropdown-menu " v-if="status !== 'closed' ">
          <a class="dropdown-item" href="#" @click="setTicketClosed">closed</a>
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

          <h3><span class="badge badge-primary">{{ ticket.type }}</span></h3>
        </div>
      </div>
      <div class="col-4 ">
        <div class="row justify-content-center">
          <p class="text-muted">Priority: <span v-for=" n in ticket.priority">  <i class="fas fa-exclamation mx-2 "></i> </span></p>
        </div>
      </div>
      <div class="col-4 ">
        <div class="row justify-content-center">
          <p v-if="ticket.author" class="text-muted ">Created on&nbsp;{{ ticket.created_at }}
            <span>&nbsp;By&nbsp;{{ ticket.author.first_name }}</span></p>
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

export default {
  name: 'block-ticket-component',
  components: {AttachmentListComponent},
  data() {
    return {
      read: true,
    }
  },

  computed: {
    status(){
      return this.ticket.status
    },
    status_color() {
      if (this.status === 'open' )  return "btn-primary dropdown-toggle"
      if (this.status === 'closed' ) return "btn-danger"
      if (this.status === 'in progress' ) return "btn-warning dropdown-toggle"

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
