<template>
    <div>
        <b-row>
            <b-col sm="2"></b-col>
            <b-col sm="8">
                <b-embed
                    type="iframe"
                    aspect="16by9"
                    :src="'/uploads/videos/'+part.video_url"
                    allowfullscreen
                ></b-embed>
            </b-col>
            <b-col></b-col>
        </b-row>
        <b-row class="py-3">
            <b-col sm="2"></b-col>
            <b-col sm="8">
                <b-card>
                    <b-card-title>Description</b-card-title>
                    <b-card-text>{{ part.video_desc }}</b-card-text>
                </b-card>
            </b-col>
            <b-col></b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "ShowVideo",
        props:['part']
    }
</script>

<style scoped>

</style>
