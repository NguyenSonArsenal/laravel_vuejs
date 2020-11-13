<template>

  <div>
    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
        <h2>Học sinh: Thêm mới</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link :to="{name:'Dashboard'}">Trang chủ</router-link>
          </li>
          <li class="breadcrumb-item active">
            <router-link :to="{name:'User'}"><strong> Học sinh </strong></router-link>
          </li>
        </ol>
      </div>
      <div class="col-lg-2">
        <h2>
          <!-- @todo backUrl -->
          <router-link :to="{name:'User'}" class="btn btn-sm btn-secondary float-right m-t-n-xs" type="submit">
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
              <div class="loading1" v-if="loading.processing"><img src="/backend/images/theme/ajax-loading-icon-11.jpg" alt="Loading..."/></div>
              <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                  <form action="" method="POST">

                    <div class="error alert alert-danger" v-if="errorsValidate.length > 0">
                      <ul class="mb-0">
                        <li v-for="error in errorsValidate">{{ error }}</li>
                      </ul>
                    </div>

                    <div class="row">
                      <div class="col-3">
                        <label class="col-form-label">Tên đầy đủ: <span class="input_label_required">*</span></label>
                        <input type="text" autofocus v-model="user.userName" class="form-control">
                      </div>

                      <div class="col-3">
                        <label class="col-form-label">SĐT: <span class="input_label_required">*</span></label>
                        <input type="text" autofocus v-model="user.userPhone" class="form-control">
                      </div>

                      <div class="col-3">
                        <label class="col-form-label">Email: <span class="input_label_required">*</span></label>
                        <input type="text" autofocus v-model="user.userEmail" class="form-control">
                      </div>

                      <div class="col-3">
                        <label class="col-form-label">Giới tính: </label>
                        <VueSelect
                            label="name"
                            class="v-select"
                            placeholder="Chọn giới tính"
                            :options="user.listGender"
                            v-model="user.userGender"
                            :close-on-select="true"
                            :clear-on-select="false"
                            :searchable="true"
                        ></VueSelect>
                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-3">
                        <label class="col-form-label">Địa chỉ: </label>
                        <input type="text" autofocus v-model="user.userAddress" class="form-control">
                      </div>
                    </div>

                    <br>
                    <div class="form-group row">
                      <div class="col-12">
                        <input class="btn btn-primary btn-sm" type="button" value="Thêm mới" v-on:click="addUser()">

                        <!-- @todo  add back url -->
                        <router-link :to="{name: 'User'}">
                          <button class="btn btn-secondary btn-sm" type="button">Quay lại</button>
                        </router-link>
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
  import "vue-select/dist/vue-select.css";
  import VueSelect from 'vue-select';
  import loader from "../../../components/core/Loading";

  export default {
    name: 'student-add',

    components: {
      VueSelect,
      loader
    },

    data() {
      return {
        errorsValidate: [],
        user: {
          userName: '',
          userAddress: '',
          userEmail: '',
          userPhone: '',
          listGender: [{id: 1, name: "Nam"}, {id: 2, name: "Nữ"}],
          userGender: {id: 1, name: "Nam"},
        },
        loading: {
          processing: false,
        },
      }
    },

    methods: {
      checkFormAddUser: function (e) {
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

      addUser() {
        this.loading.processing = true;
        this.axios.post('/api/users', this.user)
          .then((response) => {
            if (response.data.code === 200) {
              this.notification = response.data.message;
              this.$router.push({ name: 'User' });
            } else { // Errors validate
              this.errorsValidate = response.data.message;
            }
            this.loading.processing = false;
          })
          .catch((error) => {
            this.alert = error
          });
      },
    }
  }
</script>

<style>
  .vs__dropdown-toggle {
    width: 100%;
    height: 36px;
    border-radius: 0;
    border: 1px solid #e5e6e7;
  }

  .vs__dropdown-toggle:focus{
    border-color: #1ab394;
  }

  /*, input .vs__search:active*/
</style>
