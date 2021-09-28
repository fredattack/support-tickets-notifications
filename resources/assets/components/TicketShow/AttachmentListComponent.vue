<template>
  <div class="row">
    <div class="col-auto" v-for="media in ticket.media">
      <div v-if=" media.mime_type !== 'video/mp4' ">
      <img class="card-img-top m-4" @click="showSingle(media)" style="object-fit: contain;height: 140px" :src="media.url" :alt="media.name" >
        <vue-easy-lightbox
            scrollDisabled
            escDisabled
            moveDisabled
            :visible="visible"
            :imgs="imgs"
            :index="index"
            @hide="handleHide"
        ></vue-easy-lightbox>
      </div>

      <video class="m-4" width="250"  controls v-if=" media.mime_type === 'video/mp4' ">
        <source :src="media.url" type="video/mp4">
        Your browser does not support the video tag.
      </video>

    </div>
  </div>
</template>
<script>

export default {
  name: 'attachment-list-component',
  data() {
    return {
      imgs: '',
      visible: false,
      index: 0
    }
  },
  props: {
    ticket: {}
  },
  mounted: function () {
    console.log(this.ticket.media)
  },
  methods: {
    showSingle(media) {

      this.imgs =  media.url

      this.show()
    },
    show() {
      this.visible = true
    },
    handleHide() {
      this.visible = false
    }
  },
}
</script>
