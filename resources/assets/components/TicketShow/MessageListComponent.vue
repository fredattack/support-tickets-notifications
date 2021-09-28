<template>
  <div class="col-12 col-md-10 offset-md-1" v-if="messages" v-for="message in messages">

    <left-message-component :message="message" v-if="message.author.role !== 'super-admin'"/>

    <right-message-component :message="message" v-else/>


  </div>

</template>
<script>
import LeftMessageComponent from "./LeftMessageComponent";
import RightMessageComponent from "./RightMessageComponent";

export default {
  name: 'message-list-component',
  components: {RightMessageComponent, LeftMessageComponent},
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
