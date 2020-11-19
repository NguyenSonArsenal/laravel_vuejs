<style></style>

<template>
  <div>
    <div class="modal fade show" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Thêm mới thành công test Ok
          </div>
          <div class="modal-footer">
            <router-link :to="{name: backTo}">
              <button class="btn btn-secondary btn-sm" type="button" @click="show = !show">
                <i class="fa fa-arrow-circle-left"></i> Quay lại
              </button>
            </router-link>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" aria-label="Close"
                    @click="show = !show"><i class="fa fa-repeat"></i> OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    props: ['propModalIsShow', 'propModalBackTo'],
    data() {
      return {}
    },

    computed: {
      show: {
        get: function () {
          return this.propModalIsShow
        },
        set: function (newValue) {
          return this.show = newValue
        }
      },
      backTo: function () {
        return this.propModalBackTo;
      }
    },

    watch: {
      show: function (value) {
        if (value) {
          $("#modalInformation").modal('show');
        } else {
          $("#modalInformation").modal('hide');
        }

      }
    },
  }
</script>


