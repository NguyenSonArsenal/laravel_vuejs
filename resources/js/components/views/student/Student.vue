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

          <LoadingComponent :spin="loading.spin" :text="loading.text" :active="loading.processing" :duration="loading.duration"/>

          <div class="ibox">
            <div class="ibox-content">
              <div class="wrapper wrapper-content animated fadeInRight data_products">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="ibox ">
                      <div class="table-responsive">

                          <!-- Notification -->
                          <Notification
                              :propNotification="notification"
                              @emitOnClose="notification = !notification">
                          </Notification>
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
                            <tr v-for="(student, index) in students.data">
                              <td>{{ student.id }}</td>
                              <td>{{ student.full_name }}</td>
                              <td>{{ student.phone_number }}</td>
                              <td>{{ student.gender | showGender }}</td>
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

                          <!-- pagination -->
                          <MyPagination
                              @pagination-change-page="getStudents"
                              :data="students"
                              :limit="myPagination.perPage"
                          >
                          </MyPagination>
                          <!-- End pagination -->
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
  import Notification from "../../includes/Nofication";
  export default {
    components: {Notification},
    data() {
      return {
        students: {},
        notification: '',
        myPagination: {
          perPage: 5
        },
        router_url: "api/students",
        loading: {
          spin: 'mini',
          text: 'Đang xử lý ...',
          processing: false,
          duration: 300
        },
        pagination: {
          spage: 0,
          ppage: 0,
          npage: 0,
          lpage: 0,
          cpage: 1,
          total: 0,
          limit: 6,
          pages: []
        },
      }
    },

    mounted() {
      console.log('Component mounted');
      // Fetch initial results
      this.getStudents();
    },

    methods: {
      getStudents(page = 1) {
        this.loading.processing = true;

        const pagination = {
          perPage: this.myPagination.perPage,
        };

        this.axios.get('api/students?page=' + page + '&pagination=' + JSON.stringify(pagination))
          .then((response) => {
            this.students = response.data;
            this.loading.processing = false;
          })
          .catch((error) => {
            alert(error);
          });
      },

      // Delete a student
      deleteStudent(id) {
        if (confirm('Are you sure?')) {
          this.loading.processing = true;
          this.axios.delete('api/students/' + id)
            .then((response) => {
              if (response.status === 200) {
                this.notification = response.data.message;
                this.getStudents();
              }
              this.loading.processing = false;
            })
            .catch((error) => {
              console.log('Error: something in wrong');
              console.log(error);
            });
        }
      },

      goTo(link) {
        const info = link.toString().split("/");
        const page = info.length > 1 ? info[info.length - 1] : 1;
        this.pagination.cpage = parseInt(page);
        this.getStudent2();
      },

      getStudent2() {
        this.loading.processing = true;

        const pagination = {
          perPage: this.myPagination.perPage,
        };

        this.axios.get('api/students?pagination=' + JSON.stringify(pagination))
          .then((response) => {
            this.students = response.data;
            this.loading.processing = false;
          })
          .catch((error) => {
            alert(error);
          });
      },
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
