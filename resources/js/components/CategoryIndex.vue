<template>
    <b-container class="py-4">
        <h3>Categories</h3>
        <b-button v-b-modal.modal-create>Create new category</b-button>
        <b-table responsive="true" hover :items="categories" :fields="fields" primary-key="id">
            <template v-slot:cell(buttons)="data">
                <b-button-group>
                    <b-button variant="info" v-b-modal.modal-edit @click="setEdit(data.item)">Edit</b-button>
                    <b-button variant="danger" @click="deleteCategory(data.item)">Delete</b-button>
                </b-button-group>
            </template>
        </b-table>

        <b-modal id="modal-create" title="New category">
            <b-row>
                <b-col md="3">
                    <label>Category name:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="newCategoryName"></b-input>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="primary" @click="$bvModal.hide('modal-create'), createCategory(newCategoryName)">Create</b-button>
                <b-button variant="secondary" @click="$bvModal.hide('modal-create')">Cancel</b-button>
            </template>
        </b-modal>

        <b-modal id="modal-edit" title="New name">
            <b-row>
                <b-col md="3">
                    <label >Category name:</label>
                </b-col>
                <b-col md="9">
                    <b-input v-model="edit.name"></b-input>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="primary" @click="$bvModal.hide('modal-edit'), updateCategory(edit), setEdit()">Update</b-button>
                <b-button variant="secondary" @click="$bvModal.hide('modal-edit'), setEdit()">Cancel</b-button>
            </template>
        </b-modal>
    </b-container>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CategoryIndex",
        data() {
            return {
                categories: [],
                newCategoryName: '',
                edit: {
                    id: -1,
                    name: ''
                },
                fields: [
                    {
                        key: 'id',
                        sortable: true
                    },
                    {
                        key: 'name',
                        sortable: true
                    },
                    {
                        key: 'created_at',
                        sortable: true,
                    },
                    {
                        key: 'updated_at',
                        sortable: true,
                    },
                    {
                        key: 'buttons',
                        label: '',
                        sortable: false
                    }
                ]
            }
        },

        created(){
            axios.get('/api/categories').then(response => {
                this.categories = response.data;
            });
        },

        methods:{

            setEdit (category) {
                if (this.edit.id !== -1) {
                    this.edit.id = -1;
                    this.edit.name = '';
                } else {
                    this.edit.id = category.id;
                    this.edit.name = category.name;
                }
            },

            createCategory(name) {
                axios.post('/categories', {name: name}).then(response => {
                   this.categories.push(response.data);
                });
            },

            updateCategory(category) {
                axios.patch('/categories/' + category.id, { name: category.name })
                    .then(response => {
                        this.categories.filter(x => x.id === response.data.id)[0].name = response.data.name;
                        this.categories.filter(x => x.id === response.data.id)[0].updated_at = response.data.updated_at;
                        this.edit.id = -1;
                        this.edit.name = '';
                    });
            },

            deleteCategory (category) {
                this.$bvModal.msgBoxConfirm('Are you sure you want to delete this category.', {
                    title: 'Please Confirm',
                    size: 'sm',
                    buttonSize: 'sm',
                    okVariant: 'danger',
                    okTitle: 'YES',
                    cancelTitle: 'NO',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {
                        if(value) {
                            axios.delete('/categories/' + category.id)
                                .then(response => {
                                    this.$delete(this.categories, this.categories.findIndex(x => x.id === category.id))
                                });
                        }
                    })
            },

        }
    }
</script>
