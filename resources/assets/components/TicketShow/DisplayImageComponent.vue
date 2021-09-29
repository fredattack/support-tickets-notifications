<template>
  <img class="card-img-top m-4" @click="showSingle(url)" style="object-fit: contain;height: 140px" :src="url"
       :alt="name">
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
    url: {},
    name: {},
    type: {},
    showSingle: {},
  },
  methods: {
    showSingle(url) {
      console.log('media',url)
      this.imgs =  url
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
