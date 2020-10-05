<template>
  <div>
    <div class="row wrapper border-bottom white-bg page-heading page_products">
      <div class="col-lg-10">
        <h2>Danh sách học sinh {{ students.length }}</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="">Trang chủ</a>
          </li>
          <li class="breadcrumb-item active">
            <strong>Danh sách học sinh</strong>
          </li>
        </ol>
      </div>
      <div class="col-lg-2">
        <h2>
          <router-link :to="{name:'StudentAdd'}" class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
            <strong>Thêm mới</strong>
          </router-link>
        </h2>
      </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-content">
              <div class="wrapper wrapper-content animated fadeInRight data_products">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="ibox ">
                      <div class="table-responsive">

                          <!-- Notification -->
                          <Notification :propNotification="notification"></Notification>
                          <!-- End notification -->

                          <table class="table table-striped table-bordered table-hover dataTables-example" id="">
                            <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Address</th>
                              <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(student, index) in students">
                              <td>{{ student.id }}</td>
                              <td>{{ student.full_name }}</td>
                              <td>{{ student.phone_number }}</td>
                              <td>{{ student.gender | showGender }}</td>
                              <!--<td>{{ student.gender == 'M' ? 'Boy' : 'Girl' }}</td>-->
                              <td>{{ student.address }}</td>
                              <td>
                                <a href=""
                                   class="btn-primary btn btn-xs rounded">
                                  <i class="fa fa-edit">Sửa</i>
                                </a>

                                <a href="#model_confirm_delete" @click="deleteStudent(student.id, index)"
                                   class="btn-danger btn btn-xs model_confirm_delete rounded"
                                   data-toggle="modal"
                                   data-form-action="">
                                  <i class="fa fa-trash">Delete</i>
                                </a>

                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                  </div>
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
  import Notification from "../includes/Nofication";
  export default {
    components: {Notification},
    data() {
      return {
        students: [],
        alert: '',
        notification: ''
      }
    },

    created: function () {
      this.showStudent();
    },

    methods: {
      showStudent(notification = '') {
        this.axios.get('api/students')
          .then((response) => {
            this.students = response.data;
            this.notification = notification;
          })
          .catch((error) => {
            this.alert = error
          });
      },

      // Delete a student
      deleteStudent(id) {
        if (confirm('Are you sure?')) {
          this.axios.delete('api/students/' + id)
            .then((response) => {
              if (response.status === 200) {
                this.showStudent(response.data.message);
                // this.notification = ;
                return this.$router.push({name: 'Student'});
              }
            })
            .catch((error) => {
              console.log('Error: something in wrong');
              console.log(error);
            });
        }
      }
    },

    filters: {
      showGender: function (gender) {
        if (!gender) {
          return '';
        }
        return gender.toUpperCase() == 'M' ? 'Boy' : 'Girl';
      },
    },
  }
</script>