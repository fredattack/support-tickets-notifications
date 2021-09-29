<template>
  <div class="col-12 col-md-10 offset-md-1 border mb-5">
    <div class="card new-message-block bg-aliceblue border-0">

        <textarea class="form-control bg-aliceblue border-0"
                  placeholder="Your message here..."
                  rows="6" v-model="message.text"></textarea>
    </div>
    <div class="row col-10 offset-1 my-2">
      <new-attachments-list-component :message="message"
                                      @remove-attachment="handelRemoveAttachment"/>
      <submit-button-group-component :voice-recording="true"
                                     @pass-attachment="addAttachments"
                                     @process-submit="postMessage"/>
    </div>
  </div>
</template>
<script>
import SubmitButtonGroupComponent from "./SubmitButtonGroupComponent";
import NewAttachmentsListComponent from "./NewAttachmentsListComponent";

export default {
  name: 'new-message-block-component',
  components: {NewAttachmentsListComponent, SubmitButtonGroupComponent},
  data() {
    return {
      message: {
        text:null,
        attachments:[]
      }
    }
  },
  methods: {
    postMessage: function () {
      this.$emit('submit-message',this.message)
      this.message.text = null
      this.message.attachments = []
    },
    async  addAttachments(attachment) {
      console.log('message  attachment',attachment)


      let new_file = {
        name: attachment.type === 'audio/webm' ? `voice_recording_${Date.now()}.webm`: attachment.name,
        type: attachment.type,
        base64: await this.getBase64(attachment)
      };
      this.message.attachments.push(new_file)
    },
    async getBase64(file) {
      return new Promise(function (resolve, reject) {
        let reader = new FileReader();
        let imgResult = "";
        reader.readAsDataURL(file);
        reader.onload = function () {
          imgResult = reader.result;
        };
        reader.onerror = function (error) {
          reject(error);
        };
        reader.onloadend = function () {
          resolve(imgResult);
        };
      });
    },
    handelRemoveAttachment(deletable_attachment){
      this.message.attachments.splice(this.message.attachments.findIndex(el => el.name === deletable_attachment.name), 1);
    }
  },

}
</script>
