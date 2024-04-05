<template>
    <div>
        <AppLayout>
            <template v-slot:content>
                <div class="container">
                <div v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </div>
                    <form class="row g-3" @submit.prevent="studentUpdate(all_data.id)" enctype="multipart/form-data">
                        <h3>Edit student</h3>
                        <div class="col-auto">
                            <label for="inputName" class="visually-hidden">Full Name</label>
                            <input type="text" class="form-control" id="inputName" v-model="studentFieldUpdate.name" placeholder="Full Name">
                        </div>
                        <div class="col-auto">
                            <label for="inputAge" class="visually-hidden">Age</label>
                            <input type="number" class="form-control" id="inputAge" v-model="studentFieldUpdate.age" placeholder="Age">
                        </div>
                        <div class="mb-3">
                            <label for="inputImage" class="form-label">Image</label>
                            <input class="form-control" type="file" id="inputImage" @change="imageChange">
                        </div>
                        <br>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="studentFieldUpdate.status">
                            <label class="form-check-label" for="exampleCheck1">Active or inactive</label>
                        </div>
                        <br>
                        <div class="col-auto">
                            <button type="submit" class="mb-3 btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </template>
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import axios from 'axios';

export default {
    components: {
        AppLayout
    },
    
    props: {
        all_data: Object
    },
    
    data() {
        return {
            studentFieldUpdate: {
                name: this.all_data.name || "",
                age: this.all_data.age || "",
                status: this.all_data.status == 1,
            },
            errors: [],
        }
    },
    
    methods: {
        async studentUpdate(id) {
            const formData = new FormData();
            formData.append('name', this.studentFieldUpdate.name);
            formData.append('age', this.studentFieldUpdate.age);
            formData.append('image', this.studentFieldUpdate.image);
            formData.append('status', this.studentFieldUpdate.status ? 1 : 0);

            try {
                const res = await axios.post(route('student.update',id), formData);
                if (res) {
                   
                    this.$inertia.visit(route('student.all'));
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    console.error('Error:', error);
                }
            }
        },
        
        imageChange(event) {
            this.studentFieldUpdate.image = event.target.files[0];
        }
    }
};
</script>


<style lang="css" scoped>
</style>
