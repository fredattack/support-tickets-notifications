<template>
  <div class="row justify-content-end mb-1">

    <div class="card card-message bg-grey-light" style="min-height: 20px">
      <div class="col-10 offset-1"  v-if="message.media.length">
        <attachment-list-component :ticket="message"/>
      </div>
      {{ message.text }}
    </div>
  </div>
  <div class="row mt-0 mb-3 justify-content-end ">
    <p class="text-muted author-infos">{{ message.author.first_name }}  <span class="">{{ message.created_at }}</span></p>
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
  mounted ()  {
    console.log('message',this.message)
  },
}
</script>
