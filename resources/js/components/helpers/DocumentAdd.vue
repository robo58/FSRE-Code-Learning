<template>
    <div>
        <b-list-group>
            <b-list-group-item
                v-for="document in documents"
                :key="document.id"
            >
                        <h4>{{ document.title }}</h4>
                        <small>{{ document.description }}</small>
                    <div class="d-flex justify-content-end">
                        <b-button variant="danger" @click="onDelete(document.id)"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    </div>
            </b-list-group-item>
            <b-list-group-item>
                <div class="d-flex justify-content-center">
                    <b-button variant="primary" v-b-modal.modal-add-doc>Add document</b-button>
                </div>
            </b-list-group-item>
        </b-list-group>
        <b-modal id="modal-add-doc" title="Add new document">
            <b-row>
                <b-col md="3">
                    <label>Document title:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="newDocument.title"></b-input>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="3">
                    <label>Document description:</label>
                </b-col>
                <b-col md="9">
                    <b-textarea v-model="newDocument.description"></b-textarea>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="3">
                    <label>Document:</label>
                </b-col>
                <b-col md="9">
                    <b-form-file
                        v-model="newDocument.file"
                        :state="Boolean(newDocument.file)"
                        placeholder="Choose a file or drop it here..."
                        drop-placeholder="Drop file here..."
                    ></b-form-file>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="secondary" @click="$bvModal.hide('modal-add-doc')">Cancel</b-button>
                <b-button variant="primary" @click="$bvModal.hide('modal-add-doc'), addDocument()">Add</b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:['part'],
        data(){
            return{
                documents: [],
                newDocument:{
                    title: '',
                    description: '',
                    file: null
                }
            }
        },
        created() {
            axios.get('/files/'+this.part)
            .then(response=>{
                this.documents = response.data;
            });
        },
        methods:{
            addDocument(){
                let formData = new FormData();
                formData.append('file',this.newDocument.file);
                formData.append('title',this.newDocument.title);
                formData.append('description',this.newDocument.description);
                formData.append('course_part_id',this.part);

                axios.post('/files',formData,
                    { headers: {'Content-Type': 'multipart/form-data'}})
                .then(response=>{
                    this.documents.push(response.data);
                });
            },
            onDelete(id){
                this.$bvModal.msgBoxConfirm('Are you sure you want to delete this document.', {
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
                            axios.delete('/files/' + id)
                                .then(response => {
                                    this.$delete(this.documents, this.documents.findIndex(x => x.id === id));
                                });
                        }
                    })
            }
        }
    }
</script>
