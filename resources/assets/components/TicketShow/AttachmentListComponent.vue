<template>
  <div class="row">
    <div class="col-auto" v-for="media in ticket.media">

      <display-image-component v-if=" this.IMAGE_TYPE.includes(media.mime_type)"
                               :url="media.url" :name="media.name" :type="media.type"/>

      <display-audio-component v-if=" this.AUDIO_TYPE.includes(media.mime_type)"
                               :url="media.url" :type="media.type"
      />

      <display-video-component v-if=" this.VIDEO_TYPE.includes(media.mime_type)"
                               :url="media.url" />
    </div>
  </div>
</template>
<script>

import {audioType, imageType, videoType} from '../../helpers'

import DisplayVideoComponent from "./DisplayVideoComponent";
import DisplayAudioComponent from "./DisplayAudioComponent";
import DisplayImageComponent from "./DisplayImageComponent";

export default {
  name: 'attachment-list-component',
  components: {DisplayImageComponent, DisplayVideoComponent, DisplayAudioComponent},

  props: {
    ticket: {}
  },
  created() {
    this.VIDEO_TYPE = videoType;
    this.AUDIO_TYPE = audioType;
    this.IMAGE_TYPE = imageType;
  },

}
</script>
