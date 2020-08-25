<template>
    <b-container>
        <b-row class="justify-content-center py-4">
            <h1>Courses</h1>
        </b-row>
        <b-row class="py-4 text-center">

            <b-col sm="6">
                <label><h5>Category:</h5></label>
                <b-select v-model="newCourse.category" :options="categories" text-field="name" value-field="id">
                    <template v-slot:first>
                        <b-form-select-option :value="null" disabled>-- Please select a category --</b-form-select-option>
                    </template>
                </b-select>
            </b-col>

            <b-col sm="6">
                <label><h5>Course Title:</h5></label>
                <b-input v-model="newCourse.title"></b-input>
            </b-col>
            <b-col sm="12">
                <br />
                <b-button block variant="primary" @click="addCourse()">Add new course</b-button>
            </b-col>
        </b-row>
        <b-row class="justify-content-center py-4">
            <b-col sm="12">
                <b-list-group class="text-center">
                    <b-list-group-item v-for="course in courses" :key="course.id">
                        <h5 class="mb-1">{{course.title}}</h5>
                        <small>{{getCategory(course.category_id)}}</small>,
                        <small>{{course.created_at}}</small>
                    </b-list-group-item>
                </b-list-group>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CourseIndex",
        data() {
            return {
                courses: [],
                categories: [],
                newCourse: {
                    title: null,
                    category: null
                }
            }
        },

        created(){
            axios.get('/api/courses').then(response => {
                this.courses = response.data;
            });
            axios.get('/api/categories').then(response => {
                this.categories = response.data;
            });
        },

        methods:{

            getCategory(id){
                let cat = this.categories.filter(x=>x.id === id)[0];
                if(cat != null)
                    return cat.name;
                return '--';
            },

            addCourse(){
                axios.post('/courses',{ title: this.newCourse.title, category_id: this.newCourse.category })
                .then(response => {
                    this.courses.push(response.data);
                });
            }

        }
    }
</script>
