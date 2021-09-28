<template>

  <div class="row col-10 offset-1 my-2">
    <div class="col-auto">
      <input type="file" ref="file"  name="attachments[]" style="display: none" @change="addAttachment" accept=".mov,.mp3,.mp4, .png,.jpg,.jpeg" >
      <button type="button" @click="selectFile()" class="btn btn-outline-secondary m-1"><i class="fas fa-paperclip "></i></button>
      <button type="button" class="btn btn-success m-1"  v-show="voiceRecording" @click="startRecording"  v-if="!recording" >
        <span><i class="fas fa-microphone"></i></span>
      </button>
      <button type="button" class="btn btn-danger m-1" v-show="voiceRecording" @click="startRecording" v-if="recording" >
        <span><i class="fas  fa-times"></i></span>
      </button>
      <p v-if="recording">{{record_duration}} s.</p>
    </div>
    <div class="col-auto ml-auto ">

      <button type="button" class="btn btn-primary m-1" @click="this.$emit('process-submit')"><i class="fas fa-paper-plane "></i></button>
    </div>
  </div>
</template>
<script>

export default {
  name: 'submit-button-group-component',
  data() {
    return {

      recording: false,
      record_duration: '00',
      items : [],

      recorder : null
    }
  },mounted() {
    const device = navigator.mediaDevices.getUserMedia({audio:true})

    device.then(stream=>{
      this.recorder = new MediaRecorder(stream)


      this.recorder.ondataavailable = e =>{
          this.items.push( e.data )
        if(this.recorder.state === 'inactive' ){
          console.log('pipo')
          var blob = new Blob(this.items,{type:'audio/webm'})
          console.log(blob)
        }
      }

    })
  },
  computed:{
    class_color(){
    if(!this.recording) return "btn-success"
    return "btn-danger"
    },
  },
  props: {
    voiceRecording: {
      type: Boolean,
      default: true
    },

  },
  methods:{
    selectFile(){
      let fileInputElement = this.$refs.file;
      fileInputElement.click();

      // Do something with chosen file
    },
    addAttachment(e){
      console.log('tt', e.target.files[0])
      this.$emit('pass-attachment', e.target.files[0])

    },
    startRecording () {
      if(this.recorder && !this.recording) {
        this.recording = true
        this.recorder.start(100)
      }else if(this.recorder && this.recording){
        this.recording = false
       this.recorder.stop()
      }
     /* setTimeout(
          function (){
            this.record_duration ++ ;
          },1000)*/

    } ,

  }
}
</script>
