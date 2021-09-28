<template>
  <div class="col-12 col-md-10 offset-md-1 border mb-5">
    <div class="card new-message-block bg-aliceblue border-0">

        <textarea class="form-control bg-aliceblue border-0"
                  placeholder="Your message here..."
                  rows="6" v-model="message.text"></textarea>
    </div> <div class="row col-10 offset-1 my-2">
    <div class="col-auto">
      <ul v-if="message.attachments">
        <li v-for=" attachment in message.attachments" :key="attachment.name" >
          {{ attachment.name }}
        </li>

      </ul>
    </div>
      <submit-button-group-component :voice-recording="true"
                                     @pass-attachment="addAttachments"
                                     @process-submit="postMessage"/>
    </div>
  </div>
</template>
<script>
import SubmitButtonGroupComponent from "./SubmitButtonGroupComponent";

export default {
  name: 'new-message-block-component',
  components: {SubmitButtonGroupComponent},
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
        name:attachment.name,
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
  },
}
</script>
