<template>
  <img class="card-img-top m-4" @click="showSingle(media)" style="object-fit: contain;height: 140px" :src="media.url"
       :alt="media.name">
  <vue-easy-lightbox
      scrollDisabled
      escDisabled
      moveDisabled
      :visible="visible"
      :imgs="imgs"
      :index="index"
      @hide="handleHide"
  ></vue-easy-lightbox>
</template>
<script>
export default {
  name: 'image-component',
  data() {
    return {
      imgs: '',
      visible: false,
      index: 0
    }
  },
  props: {
    handleHide: {},
    media: {},
    showSingle: {},
  },
  methods: {
    showSingle(media) {
      console.log('media',media)
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
