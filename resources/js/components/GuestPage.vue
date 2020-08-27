<template>
    <div>
        <!--    Site template    -->
        <b-container class="border-right border-left">
            <b-row class="py-3">
                <b-col>
                    <b-jumbotron>
                        <template v-slot:header>Fsre-Code-Learning</template>

                        <template v-slot:lead>
                            Learn how to code fast and effective with us.
                        </template>
                    </b-jumbotron>
                </b-col>
            </b-row>

            <b-row class="py-3">
                <b-col>
                    <b-carousel
                        id="carousel-1"
                        :interval="4000"
                        controls
                        indicators
                        background="#ababab"
                        img-width="1024"
                        img-height="480"
                        style="text-shadow: 1px 1px 2px #333;"
                    >
                        <b-carousel-slide
                            v-for = "course in courses"
                            :key = "course.id"
                            :caption="course.title"
                            img-blank
                            :img-blank-color="random_rgba"
                        ><b-button info :href="'/courses/'+course.id" class="w-100">Go to course</b-button></b-carousel-slide>
                    </b-carousel>
                </b-col>
            </b-row>

        </b-container>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                courses: [],
            }
        },
        created(){
            axios.get('/api/courses').then(response=>{
                this.courses = response.data;
            })
        },
        methods:{
            random_rgba() {
                let o = Math.round, r = Math.random, s = 255;
                return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
            }
        }

    }
</script>
