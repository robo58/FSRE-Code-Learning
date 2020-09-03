<template>
    <b-container>
        <b-row class="justify-content-center py-4">
            <h1>Courses</h1>
        </b-row>
        <b-row class="py-4 text-center">

            <b-col sm="6">
                <label><h5>Filter by Category:</h5></label>
                <b-select v-model="filter" :options="categories" text-field="name" value-field="id">
                    <template v-slot:first>
                        <b-form-select-option value="any">Any</b-form-select-option>
                    </template>
                </b-select>
            </b-col>

        </b-row>
        <b-row class="justify-content-center py-4">
            <b-col sm="12">
                <b-list-group class="text-center">
                    <b-list-group-item v-for="course in courses" v-show="filter === 'any' || course.category_id === filter"
                                       :key="course.id" :href="checkStart(course.id) ? '/courses/'+selected.id : '#'"
                                       v-b-modal="checkStart(course.id) ? '' : 'modal-item'"
                                       @click="selected = course">
                        <h5 class="mb-1">{{course.title}}</h5>
                        <small>{{getCategory(course.category_id)}}</small>,
                        <small>{{course.created_at}}</small>
                        <small v-if="checkStart(course.id)">
                            Started, Progress: {{ started.filter(x=>x.course_id === course.id)[0].progress }}%
                        </small>
                    </b-list-group-item>
                </b-list-group>
            </b-col>
        </b-row>

        <b-modal id="modal-item" title="Start course">
            <b-row class="d-flex justify-content-center">
                <b-col>
                    <h5 class="mb-1">{{selected.title}}</h5>
                    <small>{{getCategory(selected.category_id)}}</small>,
                    <small>{{selected.created_at}}</small>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button block variant="success" @click="$bvModal.hide('modal-item'),startCourse(selected.id)" :href="'/courses/'+selected.id">Start</b-button>
                <b-button block variant="secondary" @click="$bvModal.hide('modal-item')">Cancel</b-button>
            </template>
        </b-modal>
    </b-container>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CourseIndex",
        props: ['user'],
        data() {
            return {
                courses: [],
                categories: [],
                selected: {},
                started: [],
                filter: 'any'
            }
        },

        created(){
            axios.get('/api/courses').then(response => {
                this.courses = response.data;
            });
            axios.get('/api/categories').then(response => {
                this.categories = response.data;
            });
            axios.get('/api/startedCourses/'+this.user.id).then(response => {
                this.started = response.data;
            });
        },

        methods:{

            getCategory(id){
                let cat = this.categories.filter(x=>x.id === id)[0];
                if(cat != null)
                    return cat.name;
                return '--';
            },

            startCourse(id){
                axios.post('/api/startCourse',{course_id:id,user_id:this.user.id});
            },

            checkStart(id){
                return this.started.filter(x=>x.course_id === id).length > 0;
            }

        }
    }
</script>
