<template>
  <div>
    <div class="row wrapper border-bottom white-bg page-heading page_products">
      <div class="col-lg-10">
        <h2>Danh sách học sinh</h2>
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

    <div class="wrapper wrapper-content" >

      <div class="ibox-content" >

        <div class="loading1" v-if="loading.processing">
          <img src="/backend/images/theme/ajax-loading-icon-11.jpg" alt="Loading..."/>
        </div>
        <!-- Notification -->
        <Notification
            :propNotification="notification"
            @emitOnClose="notification = !notification">
        </Notification>
        <!-- End notification -->

        <div class="table-responsive">
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
            <tr v-for="(user, index) in users.list">
              <td>{{ user.id }}</td>
              <td>{{ user.userName }}</td>
              <td>{{ user.userPhone }}</td>
              <td>{{ user.userGender | showGender }}</td>
              <td>{{ user.userAddress }}</td>
              <td>
                <a href=""
                   class="btn-primary btn btn-xs rounded">
                  <i class="fa fa-edit">Sửa</i>
                </a>

                <a href="#model_confirm_delete" @click="deleteAUser(user.id, index)"
                   class="btn-danger btn btn-xs model_confirm_delete rounded"
                   data-toggle="modal"
                   data-form-action="">
                  <i class="fa fa-trash">Delete</i>
                </a>

              </td>
            </tr>
            </tbody>
          </table>

          <div class="table-footer">
            <div class="paging-info"><strong>Tổng số {{ users.total }} bản ghi</strong></div>
            <MyPagination
                @pagination-change-page="getUsers"
                :data="users.pagination"
                :limit="myPagination.limit"
            >
            </MyPagination>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Notification from "../../includes/Nofication";

  import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
  import BarLoader from '@saeris/vue-spinners'

  export default {
    components: {
      Notification,
      PulseLoader,
      BarLoader
    },
    data() {
      return {
        users: {
          pagination: {},
          list: [],
          total: ''
        }, // for paginate

        notification: '',
        myPagination: {
          perPage: 5
        },
        router_url: "api/users",
        loading: {
          spin: 'mini',
          text: 'Đang xử lý ...',
          processing: false,
          duration: 300
        },
      }
    },

    created() {
      this.getUsers();
    },

    methods: {
      getUsers(page = 1) {
        this.loading.processing = true;

        const pagination = {
          perPage: this.myPagination.perPage,
        };

        this.axios.get('api/users?page=' + page + '&pagination=' + JSON.stringify(pagination))
          .then((response) => {
            this.users.pagination = response.data;
            this.users.list = this.users.pagination.data;
            this.users.total = this.users.pagination.total;
            this.loading.processing = false;
          })
          .catch((error) => {
            alert(error);
          });
      },

      // Delete a student
      deleteAUser(id) {
        if (confirm('Are you sure?')) {
          this.loading.processing = true;
          this.axios.delete('api/users/' + id)
            .then((response) => {
              if (response.status === 200) {
                this.notification = response.data.message;
                this.getUsers();
              }
              this.loading.processing = false;
            })
            .catch((error) => {
              console.log('Error delete a user function: something in wrong');
              console.log(error);
            });
        }
      },

      goTo(link) {
        const info = link.toString().split("/");
        const page = info.length > 1 ? info[info.length - 1] : 1;
        this.pagination.cpage = parseInt(page);
        this.getUser2();
      },

      getUser2() {
        this.loading.processing = true;

        const pagination = {
          perPage: this.myPagination.perPage,
        };

        this.axios.get('api/users?pagination=' + JSON.stringify(pagination))
          .then((response) => {
            this.users = response.data;
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


<style>
  .loading {
    border: 1px solid red;
    background-color: white;
    position: fixed;
    display: block;
    top: 0;
    bottom: 0;
    z-index: 1000000;
    opacity: 0.75;
    width: 100%;
    height: 100%;
    text-align: center;
  }

  .loading img {
    width: 65px;
    margin: auto;
    display: block;
    top: calc(50% - 100px);
    left: calc(50% - 10px);
    position: absolute;
    z-index: 999999;
  }

  .loading1 {
    background-color: white;
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    z-index: 1000000;
    opacity: 0.75;
    width: 100%;
    height: 100%;
    text-align: center;
  }

  .loading1 img {
    width: 65px;
    margin: auto;
    display: block;
    top: calc(50% - 100px);
    left: calc(50% - 10px);
    position: absolute;
    z-index: 999999;
  }

  .ibox-content {
    position: relative;
  }

  .table-footer {
    vertical-align: middle;
    margin: 0 auto;
    height: 31px;
  }

  .paging-info {
    float: left;
    text-align: left;
    margin: 0 auto;
    vertical-align: middle;
    display: inline-flex;
    line-height: 30px;
    font-style: italic;
  }

  ul.pagination {
    text-align: right;
    float: right;
    display: inline-flex;
    margin-bottom: 0;
    vertical-align: middle;
    margin: 0 auto;
  }
</style>
