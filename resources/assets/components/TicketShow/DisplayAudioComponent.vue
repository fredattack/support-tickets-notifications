<template>
  <audio class="m-md-4"  controls >
    <source :src="url" :type="type">
    Your browser does not support the video tag.
  </audio>
</template>
<script>
export default {
  name: 'display-audio-video-component',
  props: {
    url: {},
    type: {}
  }
}
</script>
