<template>
    <b-container class="py-4">
        <b-row>
            <b-col md="10">
                <h3>Categories</h3>
            </b-col>
        </b-row>
        <b-row no-gutters class="py-3">
            <b-col md="2" class="d-flex justify-content-start">
                <label ><h6>Items per page:</h6></label>
                <b-select v-model="perPage">
                    <b-form-select-option :value="5">5</b-form-select-option>
                    <b-form-select-option :value="10">10</b-form-select-option>
                    <b-form-select-option :value="15">15</b-form-select-option>
                    <b-form-select-option :value="25">25</b-form-select-option>
                    <b-form-select-option :value="50">50</b-form-select-option>
                </b-select>
            </b-col>
            <b-col sm="1"></b-col>
            <b-col class="d-flex justify-content-center">
                <label>Search categories:</label>
                <b-input type="search" v-model="filter"></b-input>
            </b-col>
            <b-col class="d-flex justify-content-end">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="categories-table"
                ></b-pagination>
            </b-col>
        </b-row>
        <b-table
            id="categories-table"
            responsive="true"
            hover
            :busy="isBusy"
            :items="categories"
            :filter="filter"
            :per-page="perPage"
            :current-page="currentPage"
            :fields="fields"
            primary-key="id"
        >
            <template v-slot:cell(buttons)="data">
                <b-button-group>
                    <b-button variant="primary" :href="'/categories/'+data.item.id"><b-icon-newspaper></b-icon-newspaper></b-button>
                </b-button-group>
            </template>
        </b-table>
    </b-container>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CategoryStudents",
        props: ['user'],
        data() {
            return {
                categories: [],
                perPage: 10,
                currentPage: 1,
                filter: null,
                isBusy: true,
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

        computed:{
            rows() {
                return this.categories.length;
            }
        },


        created(){
            axios.get('/api/categories').then(response => {
                this.categories = response.data;
                this.isBusy = false;
            });
        },

        methods:{


        }
    }
</script>
