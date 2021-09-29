<template>
  <video class="m-4" width="250" controls >
    <source :src="url" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</template>
<script>
export default {
  name: 'display-audio-video-component',
  props: {
    url: {},

  },

}
</script>
