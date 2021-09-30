<template>

  <div class="table-responsive col-10 offset-1 my-5">
    <table class="table table-bordered table-hover text-center">
      <thead>
      <tr>
        <th>Title</th>
        <th>description</th>
        <th>Author</th>
        <th><i class="fa fa-comment-alt"></i></th>
      </tr>
      </thead>
      <tbody v-if="ticketsList && ticketsList.length">
        <tr v-for="(ticket,index) in ticketsList" :key="index" class="ticket-block">
          <td @click="showTicket(ticket.id)">
            <div class="row justify-content-center">
              <a href="#" class="text-decoration-none text-body text-capitalize align-self-center"><h6>
                {{ ticket.title }}</h6></a>
            </div>
          </td>
          <td @click="showTicket(ticket.id)">
            {{ ticket.description }}
          </td>
          <td>
            {{ ticket.author.first_name }}
          </td>
          <td>
            {{ ticket.messages.length }}
          </td>
      </tr>
      </tbody>
      <tbody v-else>
      <tr>
        <td colspan="3">No record found.</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "TicketList",
  data() {
    return {
      ticketsList: [],
      ticket_count: 0
    }
  },
  mounted() {
    this.fetchTickets()
  },
  watch: {
    // call again the method if the route changes
    '$route': 'fetchTickets'
  },
  methods: {
    fetchTickets: async function () {
      const active = this.$route.name !== 'archived';
      await axios.get(`/api/ticket?active=${active}`).then(({data}) => {
        console.log('data ...', data)
        console.log('tickets ...', data.tickets)
        console.log('auth ...', data.auth)
        this.ticketsList = data.tickets
        this.ticket_count = data.tickets.total
        this.$store.dispatch('insertAuth', data.auth)
      }).catch(({response}) => {
        console.error('test', response)
      })
    },
    showTicket: function (id) {
      console.log('id', id)
      this.$router.push({name: 'show-ticket', params: {id: id}})
    }
  }
}

</script>

<style scoped>

</style>
