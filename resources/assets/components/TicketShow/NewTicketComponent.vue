<template>
  <div class="border my-5 p-3">
    <div class="col-12 col-md-10 offset-md-1">
      <div class="form-group">
        <label for="title-input">Title</label>
        <input type="text" class="form-control" id="title-input" v-model.trim="ticket.title">
        <p class="text-danger" v-if="errors.title" v-for="error in errors.title"><small>{{ error }}</small></p>
      </div>
      <div class="form-group">
        <label for="text-input">Description</label>
        <textarea class="form-control" id="text-input" placeholder="your text here... "
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
            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="fixe"
                   v-model="ticket.type">
            <label class="form-check-label" for="inlineRadio1">bug fixe</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.type" checked name="type" id="inlineRadio2"
                   value="help">
            <label class="form-check-label" for="inlineRadio2">help</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.type" name="type" id="inlineRadio3"
                   value="feature">
            <label class="form-check-label" for="inlineRadio3">new feature</label>
          </div>
          <p class="text-danger" v-if="errors.type" v-for="error in errors.type"><small>{{ error }}</small></p>
        </div>

        <div class="col-6" v-if="ticket.type !== 'fixe'">
          <div class="form-group">
            <label for="title-input">Priority</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio1"
                   value="1">
            <label class="form-check-label" for="priorityRadio1">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio2"
                   value="2">
            <label class="form-check-label" for="priorityRadio2">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio3"
                   value="3">
            <label class="form-check-label" for="priorityRadio3">3</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio4"
                   value="4">
            <label class="form-check-label" for="priorityRadio4">4</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" v-model="ticket.priority" name="priority" id="priorityRadio5"
                   value="5">
            <label class="form-check-label" for="priorityRadio5">5</label>
          </div>
          <p class="text-danger" v-if="errors.priority" v-for="error in errors.priority"><small>{{ error }}</small></p>
        </div>
      </div>
      <div class="row col-10 offset-1 my-2">
          <p class="text-danger" v-if="errors.attachments" v-for="error in errors.attachments"><small>{{ error }}</small></p>
        <div class="col-auto">
          <ul v-if="ticket.attachments">
            <li :key="attachment.name" v-for=" attachment in ticket.attachments">
              {{ attachment.name }}
            </li>

          </ul>
        </div>
      </div>
    </div>
    <submit-button-group-component
        :voice-recording="false"
        @pass-attachment="addAttachments"
        @process-submit="postTicket"
    />
  </div>
</template>
<script>
import SubmitButtonGroupComponent from "./SubmitButtonGroupComponent";

export default {

  name: 'new-ticket-component',
  components: {SubmitButtonGroupComponent},
  data() {
    return {
      ticket: {
        type: 'help',
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
        name: attachment.name,
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
    }
  },
  mounted() {
    // console.log('mounted test-component')
  }
}
</script>
