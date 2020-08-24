<template>
    <div>
        <b-card no-body>
            <b-tabs pills card vertical>
                <b-tab v-for="part in parts" :key="part.id" :title="part.title">
                    <b-card-text>
                        <b-form-group label="Choose lesson type">
                            <b-form-radio-group
                                v-model="part.lessonType"
                                :options="options"
                                name="radio-inline"
                            ></b-form-radio-group>
                        </b-form-group>
                        <course-part-edit-text v-if="part.lessonType === 'text'"/>
                        <course-part-edit-video v-if="part.lessonType === 'video'"/>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import axios from 'axios';
    import CoursePartEditText from "./CoursePartEditText";
    import CoursePartEditVideo from "./CoursePartEditVideo";
    export default {
        name: "CoursePart",
        components: {CoursePartEditVideo, CoursePartEditText},
        data(){
            return {
                options: [
                    { text: 'Video lesson', value: 'video' },
                    { text: 'Text lesson', value: 'text' }
                ],
                parts: [
                    {id: 1, title: 'Part 1', body: '', lessonType: '',},
                    {id: 2, title: 'Part 2', body: '', lessonType: '',}
                ],
            }
        }

    }
</script>
