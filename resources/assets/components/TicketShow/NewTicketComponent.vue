<template>
  <div class="border my-md-5 p-md-3">
    <div class="col-12 col-md-10 offset-md-1">
      <div class="form-group">
        <label for="title-input">{{ t('title') }}</label>
        <input type="text" class="form-control" id="title-input" v-model.trim="ticket.title">
        <p class="text-danger" v-if="errors.title" v-for="error in errors.title"><small>{{ error }}</small></p>
      </div>
      <div class="form-group">
        <label for="text-input">{{ t('description') }}</label>
        <textarea class="form-control" id="text-input"
                  :placeholder="t('your_mess_here')"
                  v-model.trim="ticket.description"></textarea>
        <p class="text-danger" v-if="errors.description" v-for="error in errors.description"><small>{{ error }}</small>
        </p>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="title-input">Type</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="inlineRadio1"
                   value="fixe"
                   v-model="ticket.type">
            <label class="form-check-label" for="inlineRadio1">{{ t('fixe') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.type" checked name="type" id="inlineRadio2"
                   value="help">
            <label class="form-check-label" for="inlineRadio2">{{ t('help') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.type" name="type" id="inlineRadio3"
                   value="feature">
            <label class="form-check-label" for="inlineRadio3">{{ t('feature') }}</label>
          </div>
          <p class="text-danger" v-if="errors.type" v-for="error in errors.type"><small>{{ error }}</small></p>
        </div>

        <div class="col-6" v-if="ticket.type !== 'fixe'">
          <div class="form-group">
            <label for="title-input">{{ t('priority') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio1"
                   value="1">
            <label class="form-check-label" for="priorityRadio1">{{ t('priority_1') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio2"
                   value="2">
            <label class="form-check-label" for="priorityRadio2">{{ t('priority_2') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio3"
                   value="3">
            <label class="form-check-label" for="priorityRadio3">{{ t('priority_3') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio4"
                   value="4">
            <label class="form-check-label" for="priorityRadio4">{{ t('priority_4') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio5"
                   value="5">
            <label class="form-check-label" for="priorityRadio5">{{ t('priority_5') }}</label>
          </div>
          <p class="text-danger" v-if="errors.priority" v-for="error in errors.priority"><small>{{ error }}</small></p>
        </div>
      </div>
      <div class="row col-12 col-md-10 offset-md-1 my-md-2">
          <p class="text-danger" v-if="errors.attachments" v-for="error in errors.attachments"><small>{{ error }}</small></p>
        <new-attachments-list-component :message="ticket"
                                        @remove-attachment="handelRemoveAttachment"/>
      </div>
    </div>
    <submit-button-group-component
        :voice-recording="true"
        @pass-attachment="addAttachments"
        @process-submit="postTicket"
    />
  </div>
</template>
<script>
import NewAttachmentsListComponent from "./NewAttachmentsListComponent";
import SubmitButtonGroupComponent from "./SubmitButtonGroupComponent";
import {useI18n} from "vue-i18n";

export default {

  name: 'new-ticket-component',
  components: {SubmitButtonGroupComponent,NewAttachmentsListComponent},
  setup() {
    const {t, locale} = useI18n();
    return {t, locale}
  },
  data() {
    return {
      ticket: {
        type: 'help',
        priority: 3,
        attachments: []
      },
      errors: []
    }
  },

  methods: {
    async addAttachments(attachment) {
      // if(attachment)
      console.log('attachment', attachment)
      console.log('attachment.size', attachment.size)
      if (attachment.size > 20000000) {
        this.errors ['attachments'] = "Max size is 20 Mb"
        return
      }
      this.errors = []
      let new_file = {
        name: attachment.type === 'audio/webm' ? `voice_recording_${Date.now()}.webm`: attachment.name,
        type: attachment.type,
        base64: await this.getBase64(attachment)
      };
      this.ticket.attachments.push(new_file)
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
    async postTicket() {
      console.log('ticket', this.ticket.attachments)

      await axios.post(`/api/ticket`, this.ticket).then(({response}) => {
        this.$router.push({name: 'home'})
      }).catch(({response}) => {
        this.errors = response.data.errors
        console.log('!!!!!!!!!!! error !!!!!!!!!!')
        console.error('errorr', response)
      })
    },
    handelRemoveAttachment(deletable_attachment){
      this.ticket.attachments.splice(this.ticket.attachments.findIndex(el => el.name === deletable_attachment.name), 1);
    }

  },
  mounted() {
    // console.log('mounted test-component')
  }
}
</script>
