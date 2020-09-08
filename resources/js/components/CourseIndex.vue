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
                    <b-list-group-item v-for="course in courses" :key="course.id" href="#" v-b-modal.modal-item @click="selected = course.id">
                        <h5 class="mb-1">{{course.title}}</h5>
                        <small>by {{course.author.name}},</small>
                        <small>{{getCategory(course.category_id)}}</small>,
                        <small>{{course.created_at}}</small>
                        <small v-if="checkStart(course.id)">
                            Started, Progress: {{ started.filter(x=>x.course_id === course.id)[0].progress }}%
                        </small>
                    </b-list-group-item>
                </b-list-group>
            </b-col>
        </b-row>

        <b-modal id="modal-item" title="Choose show,edit or delete">
            <b-row class="d-flex justify-content-center">
                <b-col>
                    <b-button block variant="primary" @click="$bvModal.hide('modal-item')" :href="'/courses/'+selected"><b-icon-newspaper /></b-button>
                </b-col>
                <b-col>
                    <b-button block variant="secondary" @click="$bvModal.hide('modal-item')" :href="'/courses/'+selected+'/edit'"><b-icon-pencil /></b-button>
                </b-col>
                <b-col>
                    <b-button block variant="danger" @click="$bvModal.hide('modal-item'), deleteCourse(selected)"><b-icon-trash /></b-button>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <br />
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

            addCourse(){
                axios.post('/courses',{ title: this.newCourse.title, category_id: this.newCourse.category, user_id:this.user.id })
                .then(response => {
                    this.courses.push(response.data);
                });
            },

            deleteCourse (id) {
                this.$bvModal.msgBoxConfirm('Are you sure you want to delete this course.', {
                    title: 'Please Confirm',
                    size: 'sm',
                    buttonSize: 'sm',
                    okVariant: 'danger',
                    okTitle: 'YES',
                    cancelTitle: 'NO',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: false
                })
                    .then(value => {
                        if(value) {
                            axios.delete('/courses/' + id)
                                .then(response => {
                                    this.$delete(this.courses, this.courses.findIndex(x => x.id === id))
                                });
                        }
                    })
            },

            checkStart(id){
                return this.started.filter(x=>x.course_id === id).length > 0;
            }

        }
    }
</script>
