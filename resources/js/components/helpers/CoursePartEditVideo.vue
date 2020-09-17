<template>
    <b-row no-gutters class="py-4">
        <b-col sm="3"></b-col>
        <b-col sm="6">
            <b-form-file
                v-model="file1"
                :state="Boolean(file1)"
                accept="video/*"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
            ></b-form-file>
        </b-col>
        <b-col sm="3"></b-col>

        <b-col sm="3"></b-col>
        <b-col sm="6" class="py-3">
            <b-textarea placeholder="Enter video description..." v-model="video_descr" @input="uploaded=false">

            </b-textarea>
        </b-col>
        <b-col sm="3"></b-col>

        <b-col sm="3"></b-col>
        <b-col sm="6" class="py-2">
            <b-button
                :variant="uploaded ? 'success' : 'primary'"
                @click="uploadFile"
                :disabled="!Boolean(file1) || uploaded"
                v-text="uploaded ? 'Uploaded!' : 'Upload video'"
            >
            </b-button>
        </b-col>
        <b-col sm="3"></b-col>
    </b-row>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CoursePartEditVideo",
        props:['video_desc'],
        data() {
            return {
                file1: null,
                video_descr: '',
                uploaded: false
            }
        },

        created() {
            if(this.video!=null){
                this.uploaded=true;
            }
            if(this.video_desc!=null){
                this.video_descr=this.video_desc;
            }
        },

        methods:{
            uploadFile(){
                let formData = new FormData();
                formData.append('file',this.file1);
                axios.post('/api/uploadVideo',formData,{ headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response=>{
                    this.$emit('upload',{video_url: this.file1.name, video_desc: this.video_descr});
                });
            }
        }

    }
</script>
