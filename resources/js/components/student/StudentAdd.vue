<template>
    <section class="container col-md-6">
        <router-link :to="{name:'Student'}" class="btn btn-outline-success" style="margin:5px">Back</router-link>
        <h1>Add Student</h1>
        <section class="alert alert-danger" v-if="alert!==''">{{alert}}</section>
        <form @submit.prevent="addCategory" method="post">
            <section class="form-group">
                <label>Tên đầy đủ</label>
                <input type="text" autofocus required v-model="student.full_name" class="form-control">
            </section>

            <section class="form-group">
                <label>Địa chỉ</label>
                <input type="text" autofocus required v-model="student.address" class="form-control">
            </section>


            <section class="form-group">
                <label>SĐT</label>
                <input type="text" autofocus required v-model="student.phone_number" class="form-control">
            </section>

            <section class="form-group">
                <input type="submit" value="Add" class="btn btn-outline-success">
            </section>
        </form>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                student: {},
                alert: ''
            }
        },
        methods: {
            addCategory() {
                this.axios.post('/api/students', this.student)
                    .then((res) => {
                        this.$router.push({name: 'Student'})
                    })
                    .catch((error) => {
                        this.alert = error
                    });
            }
        }
    }
</script>