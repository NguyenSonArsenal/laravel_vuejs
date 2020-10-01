<template>

    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Học sinh: Thêm mới</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'app'}">Home</router-link>
                    </li>
                    <li class="breadcrumb-item active">
                        <router-link :to="{name:'Student'}"><strong> Học sinh </strong></router-link>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
                <h2>
                    <!-- @todo backUrl -->
                    <router-link :to="{name:'Student'}" class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                        <strong>Quay lại</strong>
                    </router-link>
                </h2>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                                <a class="nav-link active" data-toggle="tab" href="#tab-1"> Thông tin học sinh</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <form action="" method="POST">

                                        <div class="error alert alert-danger" v-if="errors.length > 0">
                                            <ul class="mb-0">
                                                <li v-for="error in errors">{{ error }}</li>
                                            </ul>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên đầy đủ: <span class="input_label_required">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" autofocus v-model="student.full_name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Địa chỉ: </label>
                                            <div class="col-sm-8">
                                                <input type="text" v-model="student.address" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SĐT: <span class="input_label_required">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="number" v-model="student.phone_number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-8 offset-sm-2">
                                                <!-- @todo  add back url -->
                                                <router-link :to="{name: 'Student'}">
                                                    <button class="btn btn-primary btn-sm" type="button">Hủy</button>
                                                </router-link>

                                                <input class="btn btn-primary btn-sm" type="button" value="Thêm mới" v-on:click="addCategory()">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'student-add',

        data() {
            return {
                errors: [],
                student: {
                    full_name: '',
                    address: '',
                    phone_number: ''
                }
            }
        },

        methods: {
            checkFormAddStudent: function (e) {
                return true;
                if (this.student.full_name) {
                    return true;
                }

                this.errors = [];

                if (!this.student.full_name || !this.student.phone_number) {
                    this.errors.push('Tên đầy đủ là bắt buộc nhập')
                    this.errors.push('SĐT là bắt buộc nhập')
                }

                e.preventDefault();
            },

            addCategory() {
                this.axios.post('/api/students', this.student)
                    .then((response) => {
                        if (response.data.ok) {
                            console.log('Redirect ...');
                            return this.$router.push({name: 'Student'});
                            return showSuccessFlash(response.message);
                        }

                        // this.$router.push({name: 'Student'})
                    })
                    .catch((error) => {
                        this.alert = error
                    });
            },
        }
    }
</script>