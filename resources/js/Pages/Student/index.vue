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
                <form class="row g-3" @submit.prevent="studentStore" enctype="multipart/form-data">
                    <h3>Add student</h3>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Full Name</label>
                        <input type="text" class="form-control" id="inputName" v-model="studentField.name" placeholder="Full Name">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Age</label>
                        <input type="number" class="form-control" id="inputAge" v-model="studentField.age" placeholder="Age">
                    </div>
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="inputImage" @input="studentField.image = $event.target.files[0]">
                    </div><br>
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
    
    data(){
        return{
            studentField:{
                name: '',
                age: '',
                image: '',
            },
            errors: [],
        }
    },

    
    methods:{
        async studentStore() {
            const formData = new FormData();
            formData.append('name', this.studentField.name);
            formData.append('age', this.studentField.age);
            formData.append('image', this.studentField.image);

            try {
                var res = await axios.post(route('student.save'), formData);
                if (res) {
                    this.studentField.name = "";
                    this.studentField.age = "";
                    document.getElementById('inputImage').value = null;
                    this.studentField.image = null;
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    console.error('Error:', error);
                }
            }
        },
    }
};
</script>

<style lang="css" scoped>
</style>
