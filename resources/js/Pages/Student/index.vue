<template>
    <AppLayout>
        <template #content>
            <div class="container">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">Add Student</h1>
                </div>
                <div class="col-lg-12">
                    <form @submit.prevent="studentStore">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="student_form.name"
                                        placeholder="Enter Name" aria-label="default input example" required>
                                </div>
                                <!-- <div class="form-group mt-3">
                            <input class="form-control" type="file" ref="imageInput" @change="handleImageChange"
                                aria-label="default input example" accept="image/jpg, image/jpeg, image/png" required>
                        </div> -->
                                <div class="form-group mt-3">
                                    <input class="form-control" type="number" v-model="student_form.age"
                                        placeholder="Enter Age" aria-label="default input example" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="table">
                        <table class="table table-success table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student, key) in student_list" :key="key">
                                    <th scope="row">{{ key + 1 }}</th>
                                    <td>{{ student.name }}</td>
                                    <td>{{ student.age }}</td>
                                    <td>
                                        <span v-if="student.status == 0" class="badge bg-warning">Inactive</span>
                                        <span v-else class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" @click.prevent="deleteStudent(student.id)"
                                            class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        <button type="button" @click.prevent="editStudent(student.id)" class="btn btn-info">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button v-if="student.status == 1" type="button"
                                            @click.prevent="changeStatus(student.id)" class="btn btn-warning">
                                            <i class="bi bi-slash-circle"></i>
                                        </button>
                                        <button v-if="student.status == 0" type="button"
                                            @click.prevent="changeStatus(student.id)" class="btn btn-success">
                                            <i class="bi bi-check2-all"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>

        <template #modals>
            <div class="modal fade" id="studentEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="studentEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="studentEditLabel">Main Task Edit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="studentEditContent">
                            <form @submit.prevent="studentUpdate">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" v-model="student_update_form.name"
                                                placeholder="Enter Name" aria-label="default input example" required />
                                        </div>
                                        <div class="form-group mt-3">
                                            <input class="form-control" type="number" v-model="student_update_form.age"
                                                placeholder="Enter Age" aria-label="default input example" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { computed, onBeforeMount } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        AppLayout
    },
    data() {
        return {
            student_form: {
                name: '',
                age: null
            },
            student_update_form: {
                name: '',
                age: null,
            },
            student_list: []
        }
    },
    beforeMount() {
        this.getStudents();
    },
    methods: {
        async getStudents() {
            const students = (await axios.get(route('student.list'))).data
            this.student_list = students;
        },
        async studentStore() {
            await axios.post(route('student.store'), this.student_form)
            this.getStudents();

            this.student_form.name = ''
            this.student_form.age = ''
        },
        async deleteStudent(id) {
            await axios.delete(route('student.delete', id))
            this.getStudents();
        },
        async changeStatus(id) {
            await axios.get(route('student.status', id))
            this.getStudents();
        },
        async editStudent(id) {
            const student = (await axios.get(route('student.get', id))).data
            this.student_update_form = student
            $('#studentEdit').modal('show')
        },
    }
}
</script>

<style lang="css" scoped>
.page-title {
    padding-top: 5vh;
    font-size: 5rem;
    color: rgb(58, 227, 137);
}
</style>
