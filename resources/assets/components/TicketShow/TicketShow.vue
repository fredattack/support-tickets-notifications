<template>
  <section>
    <block-ticket-component :ticket="ticket" @setTicket-closed="handleTicketClosed"/>

    <message-list-component :messages="ticket.messages"/>

    <new-message-block-component @submit-message="submitMessage" v-if="['open' ,'in progress'].includes(ticket.status ) "/>
  </section>
</template>

<script>
import BlockTicketComponent from "./BlockTicketComponent";
import NewMessageBlockComponent from "./NewMessageBlockComponent";
import MessageListComponent from "./MessageListComponent";

export default {
  name: "TicketShow",
  components: {MessageListComponent, NewMessageBlockComponent, BlockTicketComponent},
  props: ['id'],
  data() {
    return {
      ticket: {},
    }
  },
  mounted() {
    this.fetchTicket()
  },

  methods: {
    fetchTicket: async function () {
      await axios.get(`/api/ticket/${this.$props.id}`).then(({data}) => {
        console.log('ticket', data)
        this.ticket = data.ticket
        this.$store.dispatch('insertAuth', data.auth)
      }).catch(({response}) => {
        console.error('error', response)
      })
    },
    submitMessage: async function (message) {
      console.log('message',message)
      await  axios.post(`/api/message/${this.$props.id}`, message).then(({response}) => {
        console.log(response)
        this.fetchTicket()
      }).catch(({response}) => {
        this.errors = response.data.errors
        console.log('!!!!!!!!!!! error !!!!!!!!!!')
        console.error('errorr', response)
      })

    },
    handleTicketClosed: async function (message) {

      await  axios.get(`/api/set-ticket-closed/${this.$props.id}`).then(({response}) => {
        console.log(response)
        this.fetchTicket()
      }).catch(({response}) => {
        this.errors = response.data.errors
        console.log('!!!!!!!!!!! error !!!!!!!!!!')
        console.error('errorr', response)
      })

    }

  }
}

</script>

