<template>
    <b-row no-gutters>
        <b-col sm="0" class="border-right" v-show="showSidebar">
            <b-list-group class="text-center">
                <b-list-group-item v-for="part in parts" :key="part.id" :href="'#'+part.id" :active="part.id === selected" @click.prevent="selectPart(part.id)" v-text="part.title"></b-list-group-item>
            </b-list-group>
        </b-col>
        <b-col>
            <b-button variant="info" class="text-white" @click="showSidebar = !showSidebar"><b-icon-arrow-bar-left v-if="showSidebar" /><b-icon-arrow-bar-right v-else /></b-button>
            <h1 class="text-center">{{ course.title }}</h1>
            <b-row no-gutters style="align-items: center;">
                <b-col sm="2" class="bg-info py-3">
                    <h4 class="text-center text-white">
                        Documentation &nbsp&nbsp<b-button @click="visible=!visible" ><b-icon-arrow-bar-down v-if="!visible" class="mx-3" /><b-icon-arrow-bar-up v-else class="mx-3" /></b-button>
                    </h4>
                    <b-collapse :visible="visible">
                        <document-get :part_id="selected"></document-get>
                    </b-collapse>
                </b-col>
                <b-col>
                    <b-progress height="25px" :value="progress" :max="max" show-progress class="mb-3"></b-progress>
                </b-col>
            </b-row>
            <div v-for="part in parts" :key="part.id" v-if="part.id === selected">
                <b-jumbotron>
                    <template v-slot:header>{{ part.title }}</template>
                    <hr class="my-4" />

                    <div class="px-3" v-html="part.body" v-if="part.body !== null && part.video_url === null" />
                    <div v-if="part.body===null && part.video_url !== null">
                        <show-video :part="part"></show-video>
                    </div>

                    <hr class="my-4" />
                    <h4 class="text-center">Exercises</h4>
                    <div v-for="exercise in exercises[parts.indexOf(part)]">
                        <exercise-completed v-if="isCompleted(exercise.id)" :q="exercise.question" :a="exercise.answer" :part_id="part.id" class="py-3" />
                        <exercise-show v-else :q="exercise.question" :a="exercise.answer" :part_id="part.id" @answerTrue="updateProgress(part,exercise.id)" class="py-3" />
                    </div>

                    <hr class="my-4" />
                    <div class="d-flex">
                        <b-button class="mr-auto p-2" :disabled="canPrevious(part)" @click="selectPrevious(part)">Previous</b-button>
                        <b-button class="p-2" :disabled="canNext(part)" @click="selectNext(part)">Next</b-button>
                    </div>
                </b-jumbotron>
            </div>
        </b-col>

    </b-row>
</template>

<script>
    import axios from 'axios';
    import ExerciseShow from "./helpers/ExerciseShow";
    import ExerciseCompleted from "./helpers/ExerciseCompleted";
    import ShowVideo from "./helpers/ShowVideo";
    import DocumentGet from "./helpers/DocumentGet";


    export default {
        name: "CourseShow",
        components: {ExerciseShow,ExerciseCompleted,ShowVideo,DocumentGet},
        props: ['course','user'],
        data() {
            return {
                showSidebar: true,
                selected: {},
                parts: [],
                exercises:[],
                completed: [],
                progress: 0,
                visible: false,
                max: 100
            }
        },

        created(){
            if(this.user.last_course_id !== this.course.id){
                axios.patch('/api/changeLastCourse',{user_id: this.user.id, course_id: this.course.id});
            }
            axios.get('/api/courses/'+this.course.id+'/getParts').then(response => {
                this.parts = response.data;
                if(this.parts.length > 0)
                {
                    for(let i = 0;i<this.parts.length;i++){
                        axios.get('/api/exercises/'+ this.parts[i].id).then(response => {
                            this.exercises.push(response.data);
                        });
                    }
                    this.selected = this.parts[0].id;
                }
            });
            axios.get('/api/courses/'+this.course.id+'/getProgress/'+this.user.id)
            .then(response=>{
                this.progress = response.data;
            })
            axios.get('/api/getCompletedExercises/'+this.user.id).then(response=>{
               this.completed = response.data;
            });
        },

        methods:{

            selectPart(id){
                this.selected = id;
            },

            canPrevious(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x-1]);
                    if(x !== -1){
                        return false;
                    }
                }
                return true;
            },

            canNext(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x+1]);
                    if(x !== -1){
                        return false;
                    }
                }
                return true;
            },

            selectPrevious(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x-1]);
                    if(x !== -1){
                        this.selected = this.parts[x].id;
                    }
                }
            },

            selectNext(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x+1]);
                    if(x !== -1){
                        this.selected = this.parts[x].id;
                    }
                }
            },

            updateProgress(part,exerciseId){
                let partProgress = Math.floor(100/this.parts.length);
                let exerciseProgress = Math.ceil(partProgress/this.exercises[this.parts.indexOf(part)].length);
                if(this.progress===1){
                    this.progress=0;
                    this.progress+=exerciseProgress;
                }else{
                    this.progress+=exerciseProgress;
                }
                if(this.progress>100){
                    this.progress=100;
                }

                axios.patch('/api/updateProgress/'+this.user.id,{progress: this.progress, course_id: this.course.id, exercise_id: exerciseId})
                .then(response=>{
                    this.completed = response.data;
                });
            },

            isCompleted(exerciseId){
                return this.completed.filter(x=>x.id === exerciseId)!=0;
            }

        }
    }
</script>
