<template>

  <div>
    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
        <h2>Users: Cập nhật thông tin</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link :to="{name:'Dashboard'}">Trang chủ</router-link>
          </li>
          <li class="breadcrumb-item active">
            <router-link :to="{name:'User'}"><strong> Users </strong></router-link>
          </li>
        </ol>
      </div>
      <div class="col-lg-2">
        <h2>
          <!-- @todo backUrl -->
          <router-link :to="{name:'User'}" class="btn btn-sm btn-secondary float-right m-t-n-xs"><i class="fa fa-arrow-circle-left"></i> Quay lại</router-link>
        </h2>
      </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li>
                <a class="nav-link active" data-toggle="tab" href="#tab-1"> Thông tin user</a>
              </li>
            </ul>
            <div class="tab-content">

              <div id="tab-1" class="tab-pane active">
                <div class="panel-body">

                  <div class="loading" v-if="loading.processing"><img src="/backend/images/theme/ajax-loading-icon-11.jpg" alt="Loading..."/></div>

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
                            :options="listGender"
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
                        <button class="btn btn-primary btn-sm" type="button" @click="updateUser()"><i class="fa fa-save"> Lưu</i></button>

                        <!-- @todo  add back url -->
                        <router-link :to="{name: 'User'}">
                          <button class="btn btn-secondary btn-sm" type="button"><i class="fa fa-arrow-circle-left"></i> Quay lại</button>
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

    <div class="modal fade show" id="modalInformation" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modal.info.isShow = !modal.info.isShow">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Cập nhật thành công
          </div>
          <div class="modal-footer">
            <router-link :to="{name: 'User'}">
              <button class="btn btn-secondary btn-sm" type="button" @click="modal.info.isShow = !modal.info.isShow">
                <i class="fa fa-arrow-circle-left"></i> Quay lại
              </button>
            </router-link>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" aria-label="Close"
                    @click="modal.info.isShow = !modal.info.isShow"><i class="fa fa-repeat"></i> OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import "vue-select/dist/vue-select.css";
  import VueSelect from 'vue-select';
  import Modal from "../../includes/Modal";

  export default {
    name: 'user-add',

    components: {
      VueSelect,
      Modal
    },

    data() {
      return {
        errorsValidate: [],
        listGender: [{id: 1, name: "Nam"}, {id: 2, name: "Nữ"}],
        user: {
          userName: '',
          userAddress: '',
          userEmail: '',
          userPhone: '',
          userGender: {id: 1, name: "Nam"},
        },
        loading: {
          processing: false,
        },
        modal: {
          info: {
            isShow: false,
            backTo: 'User'
          }
        }
      }
    },

    created() {
      this.getUser();

    },

    watch: {
      "modal.info.isShow"(newValue, oldValue) {
        this.modal.info.isShow = newValue;
        if (this.modal.info.isShow) {
          $("#modalInformation").modal('show')
        } else {
          $("#modalInformation").modal('hide')
        }
      }
    },

    methods: {
      getUser() {
        let id = this.$route.params.id;
        this.axios.get('/api/users/' + id + '/edit')
          .then((response) => {
            this.user = response.data
          })
          .catch((error) => {
            alert(error);
          });
      },

      updateUser() {
        if (this.loading.processing) return; // tránh việc gọi load liên tục

        this.loading.processing = true;
        let id = this.$route.params.id;

        this.axios.put('/api/users/' + id, this.user)
          .then((response) => {
            if (response.data.code == 200) {
              this.loading.processing = false;
              this.errorsValidate = []
              this.modal.info.isShow = true;
            } else {
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
</style>
