<template xmlns="http://www.w3.org/1999/html">

  <div class="row col-10 offset-1 my-2">
    <div class="col-auto">
      <input type="file" ref="file" name="attachments[]" style="display: none" @change="addAttachment"
             accept=".mov,.mp3,.mp4,.png,.jpg,.jpeg">
      <button type="button" @click="selectFile()" class="btn btn-outline-secondary m-1"><i
          class="fas fa-paperclip  "></i></button>
      <button type="button" class="btn  m-1" :class="class_color" v-show="voiceRecording"
              @click="handleClickRecordingButton" v-if="!this.recording">
        <i class="fas fa-microphone"></i>
      </button>
      <button type="button" class="btn  m-1" :class="class_color" v-show="voiceRecording"
              @click="handleClickRecordingButton" v-if="this.recording">
        <i class="fas fa-stop"></i>
      </button>
    </div>
    <div class="col-auto">
      <p v-if="recording" class="text-danger"><span class="spinner-grow spinner-grow-sm text-danger" role="status"
                                                    aria-hidden="true"></span>&nbsp;recording... </p>
    </div>
    <div class="col-auto">
      <p v-if="recording" class="text-danger"> {{ record_duration }} s.</p>
    </div>
    <div class="col-auto ml-auto ">

      <button type="button" class="btn btn-primary m-1" @click="this.$emit('process-submit')"><i
          class="fas fa-paper-plane "></i></button>
    </div>
  </div>
</template>
<script>


export default {
  name: 'submit-button-group-component',
  data() {
    return {
      interval : null,
      startTime: null,
      recording: false,
      record_duration: '00:00',
      new_record: {},
      recorder: null,
      streamReference: null,
    }
  },
  computed: {
    class_color() {
      if (!this.recording) return "btn-success"
      return "btn-danger"
    },

  },
  props: {
    voiceRecording: {
      type: Boolean,
      default: true
    },

  },
  methods: {
    selectFile() {
      let fileInputElement = this.$refs.file;
      fileInputElement.click();

      // Do something with chosen file
    },
    addAttachment(e) {
      console.log('tt', e.target.files[0])
      this.$emit('pass-attachment', e.target.files[0])

    },
    handleClickRecordingButton() {
      if (!this.recording) {
        this.startRecording()
      } else {
        this.stopRecording()
      }
    },
    switchRecording: function () {
      this.recording = !this.recording
    },

    async startRecording() {
      await this.initRecorder();

      this.switchRecording();

      this.recorder.start()

        this.startTime = new Date()

    this.interval = setInterval(() => {
        this.clockRunning()
      }, 1000)

      setTimeout(
          () => {
            this.stopRecording()
          }, 5 * 60 * 1000)

    },
    clockRunning() {
      var currentTime = new Date()
          , timeElapsed = new Date(currentTime - this.startTime )
          , min = timeElapsed.getUTCMinutes()
          , sec = timeElapsed.getUTCSeconds()


      this.record_duration =
          this.zeroPrefix(min, 2) + ":" +
          this.zeroPrefix(sec, 2)

    },
    zeroPrefix(num, digit) {
      var zero = '';
      for(var i = 0; i < digit; i++) {
        zero += '0';
      }
      return (zero + num).slice(-digit);
    },
    incrementTime() {
      this.record_duration = parseInt(this.record_duration) + 1;
    },
    blobToBase64: function (blob) {
      var reader = new FileReader();

      reader.readAsDataURL(blob);
      let _this = this
      reader.onloadend = function () {
        var base64data = reader.result;
        console.log(base64data);
        const date = Date.now()
        _this.new_record = {
          name: `voice_recording_${date}.webm`,
          base64: base64data
        }
        _this.recorder = null


        console.log('new_record', _this.new_record);

      }
    },
    async initRecorder() {
      const device = navigator.mediaDevices.getUserMedia({audio: true})
      var items = [];
      await device.then(stream => {
        this.streamReference = stream;

        this.recorder = new MediaRecorder(stream)

        this.recorder.ondataavailable = e => {
          items.push(e.data)
          if (this.recorder.state === 'inactive') {
            console.log('inactive')
            var blob = new Blob(items, {type: 'audio/webm'})
            this.$emit('pass-attachment', blob)

          }
        }

      })
    },
    stopRecording() {

      this.switchRecording();
      clearInterval(this.interval)
      this.recorder.stop()
      this.record_duration = '00:00'
      if (this.streamReference) {
        this.streamReference.getAudioTracks().forEach(function (track) {
          track.stop();
        });
      }

    }
  }
}
</script>
