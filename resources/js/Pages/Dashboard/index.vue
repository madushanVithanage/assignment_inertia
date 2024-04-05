<template>
    <AppLayout>
        <template v-slot:content >
            <div class="container">
                <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(view, key) in stdent_list">
                <th scope="row">{{ ++key }}</th>
                <td>{{view.name}}</td>
                <td>{{view.age}}</td>
                <td>
                    <a v-if="view.image" :href="'/uploads/images/' + view.image" target="_blank">View</a>
                </td>
                <td v-if="view.status == 0"><button type="button" class="btn btn-warning" >Deactive</button></td>
                <td v-if="view.status == 1"><button type="button" class="btn btn-success">Active</button></td>
                <td>
                    <button type="button" class="btn btn-danger" @click.prevent="deleteStudent(view.id)">Delete</button>&nbsp;&nbsp;
                    <Link type="button" class="btn btn-warning" :href="route('student.viewEdit', view.id)">Edit</Link>
                </td>
                </tr>
            </tbody>
            </table>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        AppLayout, 
        Link
    },

    data() {
        return {
            stdent_list: [],
        };
    },

    beforeMount() {
        this.fetchData();
    },

    methods: {
        async deleteStudent(id) {
            try {
                const res = await axios.delete(route('student.delete', id));
                if (res) {
                    this.fetchData();
                }
            } catch (error) {
                console.error('Error deleting student:', error);
            }
        },

        async fetchData() {
            try {
                const response = await axios.get(route('student.list'));
                this.stdent_list = response.data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

      
    },
};
</script>

<style lang="css" scoped>
</style>
