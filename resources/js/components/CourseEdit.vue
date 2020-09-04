<template>
    <b-row no-gutters>

        <!-- Sidebar -->
        <b-col sm="0" class="border-right" v-show="showSidebar">
            <b-list-group class="text-center">
                <b-list-group-item v-for="part in parts" :key="part.id" :href="'#'+part.id" :active="part.id === selected" @click.prevent="selectPart(part.id)" v-text="part.title"></b-list-group-item>
                <b-list-group-item href="#" class="bg-secondary text-white" v-b-modal.modal-create-part>Create new part</b-list-group-item>
            </b-list-group>
        </b-col>

        <!-- Content -->
        <b-col>
            <b-button variant="info" class="text-white" @click="showSidebar = !showSidebar"><b-icon-arrow-bar-left v-if="showSidebar" /><b-icon-arrow-bar-right v-else /></b-button>
            <h1 class="text-center">{{ course.title }}&nbsp&nbsp <b-button @click="setEditTitle(course.title)" v-b-modal.modal-edit-mainTitle><b-icon-pencil /></b-button></h1>
            <div v-for="part in parts" :key="part.id" v-if="part.id === selected">
                <b-row class="justify-content-center" no-gutters>
                    <h2 class="text-info">{{ part.title }} &nbsp&nbsp <b-button @click="setEditTitle(part.title)" v-b-modal.modal-edit-title><b-icon-pencil /></b-button></h2>
                </b-row>
                <b-row no-gutters>
                    <b-col sm="2">
                        <b-form-group label="Choose lesson type">
                            <b-form-radio-group
                                v-model="part.lessonType"
                                :options="options"
                                name="radio-inline"
                            ></b-form-radio-group>
                        </b-form-group>
                    </b-col>
                    <b-col sm="1">
                        <b-button variant="danger" @click="deletePart(part)"><b-icon-trash /></b-button>
                    </b-col>
                </b-row>
                <b-row no-gutters>
                    <b-col sm="12">
                        <course-part-edit-text :text="part.body!==null ? part.body : ''" v-if="part.lessonType === 'text' || part.body != null"
                                               @submitText="setBody" />
                        <course-part-edit-video v-if="part.lessonType === 'video' || part.video_url != null" />
                    </b-col>
                </b-row>
                <h4 class="text-center">Exercises</h4>
                <exercise-input v-for="exercise in part.exercises" :key="exercise.question" :part_id="part.id" :q="exercise.question" :a="exercise.answer" class="my-4 py-2" />
                <b-button variant="primary" @click="addExercise(part)">Add exercise</b-button>

            </div>
        </b-col>

        <!--    Modals    -->
        <b-modal id="modal-create-part" title="New Part">
            <b-row>
                <b-col md="3">
                    <label>Part title:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="newTitle"></b-input>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="secondary" @click="$bvModal.hide('modal-create-part')">Cancel</b-button>
                <b-button variant="primary" @click="$bvModal.hide('modal-create-part'), addPart(newTitle)">Create</b-button>
            </template>
        </b-modal>
        <b-modal id="modal-edit-title" title="Edit title">
            <b-row>
                <b-col md="3">
                    <label>Part title:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="editTitle"></b-input>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="secondary" @click="$bvModal.hide('modal-edit-title')">Cancel</b-button>
                <b-button variant="primary" @click="$bvModal.hide('modal-edit-title'), editPart()">Update</b-button>
            </template>
        </b-modal>
        <b-modal id="modal-edit-mainTitle" title="Edit title">
            <b-row>
                <b-col md="3">
                    <label>Course title:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="editTitle"></b-input>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="secondary" @click="$bvModal.hide('modal-edit-mainTitle')">Cancel</b-button>
                <b-button variant="primary" @click="$bvModal.hide('modal-edit-mainTitle'), editMainTitle()">Update</b-button>
            </template>
        </b-modal>
    </b-row>
</template>

<script>
    import axios from 'axios';
    import CoursePartEditText from "./helpers/CoursePartEditText";
    import CoursePartEditVideo from "./helpers/CoursePartEditVideo";
    import ExerciseInput from "./helpers/ExerciseInput";
    export default {
        name: "CourseEdit",
        components: {ExerciseInput, CoursePartEditVideo, CoursePartEditText},
        props: ['course'],
        data() {
            return {
                showSidebar: true,
                parts: [],
                selected: -1,
                newTitle: '',
                editTitle: '',
                options: [
                    { text: 'Video lesson', value: 'video' },
                    { text: 'Text lesson', value: 'text' }
                ],
            }
        },

        created(){
            axios.get('/api/courses/'+this.course.id+'/getParts').then(response => {
                this.parts = response.data;
                if(this.parts.length > 0)
                {
                    this.selected = this.parts[0].id;
                    this.parts.forEach(function(part){
                        axios.get('/api/exercises/'+ part.id).then(response => {
                            part.exercises = response.data;
                        });
                    });
                }
            });
            },

        methods:{

            addPart(newTitle){
                axios.post('/courseParts', { title: newTitle, course_id: this.course.id })
                .then(response => {
                    this.parts.push(response.data);
                    this.newTitle = '';
                })
            },

            selectPart(id){
                this.selected = id;
            },

            deletePart (part) {
                this.$bvModal.msgBoxConfirm('Are you sure you want to delete this part.', {
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
                            axios.delete('/courseParts/' + part.id)
                                .then(response => {
                                    this.$delete(this.parts, this.parts.findIndex(x => x.id === part.id))
                                });
                        }
                    })
            },

            setEditTitle(title){
                this.editTitle = title;
            },

            setBody(val){
                this.parts.filter(x=>x.id===this.selected)[0].body = val;
                this.editPart();
            },

            editMainTitle(){
                axios.patch('/courses/'+this.course.id,{ title: this.editTitle }).then(response=>{
                    this.course = response.data;
                });
            },

            editPart() {
                if(this.parts.filter(x=>x.id===this.selected).length > 0){
                    let editing = this.parts.filter(x=>x.id===this.selected)[0];
                    if(this.editTitle !== ''){
                        editing.title = this.editTitle;
                        this.editTitle = '';
                    }
                    axios.patch('/courseParts/'+this.selected, { coursePart: editing })
                    .then(response=>{
                        this.parts.filter(x=>x.id===this.selected)[0] = response.data;
                    })
                }
            },

            addExercise(part){
                part.exercises.push({id:-1, question: '',answer: '', course_part_id: part.id});
            }

        }
    }
</script>
