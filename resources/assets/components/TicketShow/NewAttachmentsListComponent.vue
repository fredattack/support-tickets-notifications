<template>
  <div class="col-12 col-md-auto">
    <ul v-if="message.attachments" style="list-style: none" class="p-0 m-0">
      <li v-for="attachment in message.attachments" :key="attachment.name">
<!--        <div class="row">-->
          <div class="col-10 justify-content-md-center p-sm-0 ">
            <display-image-component v-if=" this.IMAGE_TYPE.includes(attachment.type)"
                                     :url="attachment.base64" :name="attachment.name" :type="attachment.type"/>

            <display-audio-component v-if=" this.AUDIO_TYPE.includes(attachment.type)"
                                     :url="attachment.base64" :type="attachment.type"
            />

            <display-video-component v-if=" this.VIDEO_TYPE.includes(attachment.type)"
                                     :url="attachment.base64"/>
          </div>
          <div class="col-2">
            <button class="btn btn-sm btn-outline-danger border-0" @click="deleteAttachment(attachment)">
              <i class="fas fa-times "></i>
            </button>
          </div>
<!--        </div>-->
      </li>

    </ul>
  </div>
</template>
<script>
import {audioType, imageType, videoType} from '../../helpers'
import DisplayVideoComponent from "./DisplayVideoComponent";
import DisplayAudioComponent from "./DisplayAudioComponent";
import DisplayImageComponent from "./DisplayImageComponent";

export default {
  name: 'new-attachments-list-component',
  components: {DisplayImageComponent, DisplayVideoComponent, DisplayAudioComponent},
  props: {
    message: {}
  },

  created() {
    this.VIDEO_TYPE = videoType;
    this.AUDIO_TYPE = audioType;
    this.IMAGE_TYPE = imageType;
  },
  mounted() {
    console.log('message', this.message)
  },
  methods: {
    deleteAttachment(attachment) {
      this.$emit('remove-attachment', attachment)
    },
  },
}
</script>
