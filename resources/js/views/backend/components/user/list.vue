<template>
  <div>
    <div class="row wrapper border-bottom white-bg page-heading page_products">
      <div class="col-lg-10">
        <h2>Danh sách người dùng</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="">Trang chủ</a>
          </li>
          <li class="breadcrumb-item active">
            <strong>Danh sách người dùng</strong>
          </li>
        </ol>
      </div>
      <div class="col-lg-2">
        <h2>
          <router-link :to="{name:'UserAdd'}" class="btn btn-sm btn-primary float-right m-t-n-xs">
            <i class="fa fa-plus"></i> Thêm mới
          </router-link>
        </h2>
      </div>
    </div>

    <div class="wrapper wrapper-content" >

      <div class="ibox-content" >

        <MyLoading :active="loading.processing"></MyLoading>

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
                <router-link
                    class="btn-primary btn btn-xs rounded"
                    title="Nhấp vào để cập nhật thông tin user"
                    :to="`/users/${user.id}/edit`"
                ><i class="fa fa-edit">Sửa</i></router-link>

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
            <div class="paging-info">
              <small>
                Đang hiển thị trang {{ users.pagination.current_page }}/{{ users.pagination.last_page }} với {{ users.pagination.per_page }} bản ghi mỗi trang,
                tổng số có {{ users.pagination.last_page }} trang {{ users.total }} bản ghi
              </small>
            </div>
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
  import Notification from "../../includes/Notification";

  export default {
    components: {
      Notification,
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
        loading: {
          processing: false
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

        this.axios.get('/api/users?page=' + page + '&pagination=' + JSON.stringify(pagination))
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
          this.axios.delete('/api/users/' + id)
            .then((response) => {
              if (response.status === 200) {
                this.notification = response.data.message;
                this.getUsers();
                this.loading.processing = false;
              }
            })
            .catch((error) => {
              console.log('Error delete a user function: something in wrong');
              console.log(error);
            });
            this.loading.processing = false;
        }
      },

      goTo(link) {
        const info = link.toString().split("/");
        const page = info.length > 1 ? info[info.length - 1] : 1;
        this.pagination.cpage = parseInt(page);
        this.getUser2();
      },

      // get users by click pagination
      getUser2() {
        this.loading.processing = true;

        const pagination = {
          perPage: this.myPagination.perPage,
        };

        this.axios.get('/api/users?pagination=' + JSON.stringify(pagination))
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
        return gender == 1 ? 'Nam' : 'Nữ';
      },
    },
  }
</script>


<style>
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
    vertical-align: middle;
    margin: 0 auto;
  }
</style>
