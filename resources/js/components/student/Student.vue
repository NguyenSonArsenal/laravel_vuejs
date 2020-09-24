<template>
    <section class="container">
        <h1>List Student {{ students.length }} </h1>
        <section class="container alert alert-danger col-md-6" v-if="alert!==''">{{alert}}</section>
        <section>
            <router-link :to="{name:'StudentAdd'}" class="btn btn-outline-success" style="margin:5px">Add Student</router-link>
        </section>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <td>Gender</td>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students">
                <td>{{ student.id }}</td>
                <td>{{ student.full_name }}</td>
                <td>{{ student.phone_number }}</td>
                <td>{{ student.gender == 'M' ? 'Boy' : 'Girl' }}</td>
                <td>{{ student.address }}</td>
                <td>
                    <router-link :to="{name:'UpdateCategory', params:{id: student.id}}" class="btn btn-outline-info">
                        Edit
                    </router-link>
                    <button class="btn btn-outline-danger" @click="deleteStudent(student.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
    export default {
        name:'StudentList',
        data() {
            return {
                students: [],
                alert: ''
            }
        },
        created: function () {
            this.showStudent();
        },
        methods: {
            showStudent() {
                this.axios.get('api/students')
                    .then((res) => {
                        this.students = res.data
                    })
                    .catch((error) => {
                        this.alert = error
                    });
            },

            // Delete a student
            deleteStudent(id) {
                if (confirm('Are you sure?')) {
                    this.axios.delete('api/students/' + id)
                        .then((res) => {
                            this.students = res.data.students;
                            this.alert = res.data.notification
                        })
                        .catch((error) => {
                            this.alert = error
                        });
                }
            }
        }
    }
</script>