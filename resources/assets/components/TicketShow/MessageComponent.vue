<template>
  <div class="row  mb-1" :class="card_position">
    <div class="card card-message" :class="card_color" style="min-height: 20px">
      <div class="col-10 offset-1" v-if="message.media.length">
        <attachment-list-component :ticket="message"/>
      </div>
      {{ message.text }}
      <div class="row flex-row-reverse">
        <span v-if="message.read">

            <i class="fas fa-check text-success mr-3" style="font-size: 50%"></i>

        </span>
      </div>
    </div>
  </div>
  <div class="row mt-0 mb-3 " :class="card_position">
    <p class="text-muted author-infos">{{ message.author.first_name }} <span
        v-if="message.author.role === 'super-admin' ">pour ADDF</span> - <span class="">{{ message.created_at }}</span>
    </p>
  </div>
</template>
<script>
import AttachmentListComponent from "./AttachmentListComponent";

export default {
  name: 'right-message-component',
  components: {AttachmentListComponent},
  props: {
    message: {}
  },
  computed: {
    card_color() {
      if (this.message.author.role === 'super-admin') return "bg-grey-light"
      return "bg-info-light"
    },
    card_position() {
      if (this.message.author.role === 'super-admin') return "justify-content-end"
      return "justify-content-start"
    },
  }
}
</script>


