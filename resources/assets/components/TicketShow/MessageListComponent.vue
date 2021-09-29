<template>
  <div class="col-12 col-md-10 offset-md-1" v-if="messages" v-for="message in messages">
    <message-component :message="message"/>
  </div>

</template>
<script>
import MessageComponent from "./MessageComponent";

export default {
  name: 'message-list-component',
  components: {MessageComponent},
  data() {
    return {
      auth_id: 2
    }
  },
  props: {
    messages: {}
  }
}
</script>
