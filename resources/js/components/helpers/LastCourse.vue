<template>
    <div>
        <h2 class="text-center text-white">Last entered course</h2>
        <b-card>
            <b-card-title>{{ course.title }}</b-card-title>
            <b-card-body>
                <b-row class="py-3">
                    <b-col sm="2" align-self="right">
                        Progress:
                    </b-col>
                    <b-col>
                        <b-progress :value="progress" :max="100" show-progress></b-progress>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-button block variant="info" class="text-white" :href="'/courses/'+course.id">Continue</b-button>
                    </b-col>
                </b-row>
            </b-card-body>

        </b-card>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        name: "LastCourse",
        props:{
            user:{
                type: Object
            }
        },
        data(){
            return{
                course: {},
                progress: 0
            }
        },
        created() {
            axios.get('/api/getLastCourse/'+this.user.id)
            .then(response=>{
                this.course=response.data.course;
                this.progress=response.data.progress
            });
        }
    }
</script>

<style scoped>

</style>
