<template>
    <div>
        <b-list-group class="text-center">
            <b-list-group-item v-for="course in courses"
                               :key="course.id" :href="'/courses/'+course.id"
            >
                <h5 class="mb-1">{{course.title}}</h5>
<!--                <small>{{course.category.name}},</small>-->
                <small>{{course.created_at}}</small>
                <small v-if="checkStart(course.id)">
                    Started, Progress: {{ started.filter(x=>x.course_id === course.id)[0].progress }}%
                </small>
            </b-list-group-item>
        </b-list-group>
    </div>

</template>

<script>
    import axios from "axios";

    export default {
        name: "ListCourses",
        props: ['courses','user'],
        data(){
            return {
                started: [],
            }
        },
        created() {
            axios.get('/api/startedCourses/'+this.user.id).then(response => {
                this.started = response.data;
            });
        },
        methods:{
            checkStart(id){
                return this.started.filter(x=>x.course_id === id).length > 0;
            },
        }
    }
</script>

