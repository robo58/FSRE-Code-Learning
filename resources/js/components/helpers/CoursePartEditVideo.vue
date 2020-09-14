<template>
    <b-row no-gutters>
        <b-col sm="12">
            <video-player
                class="video-player-box"
                ref="videoPlayer"
                :options="playerOptions"
                :playsinline="true"
            ></video-player>
        </b-col>
    </b-row>
</template>

<script>
    import 'video.js/dist/video-js.css';

    import { videoPlayer } from 'vue-video-player';
    export default {
        name: "CoursePartEditVideo",
        components: {
            videoPlayer
        },
        data() {
            return {
                playerOptions: {
                    // videojs options
                    muted: true,
                    language: 'en',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    sources: [{
                        type: "video/mp4",
                        src: "https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm"
                    }],
                    poster: "/static/images/author.jpg",
                }
            }
        },

    }
</script>
