<template>
  <div id="">
    <br>
    <br>
    <div class="form-group  row">
      <label class="col-sm-1 col-form-label text-danger">
        <strong>*** Input</strong>
      </label>

      <div class="col-sm-4">
        <input type="text" class="form-control" v-model="message" v-on:keyup.enter="addMessage()">
      </div>

      <button class="btn btn-sm btn-primary" @click="addMessage()">
        <strong>Send</strong>
      </button>
    </div>

    <p class="text-info"></p>
    <div v-if="notification" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Bạn vừa xóa phần tử có nội dung: {{notification}}</strong>
      <button type="button" @click="notification = !notification">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <ChildComponent
        :propListMessage="listMessage"
        :propNotifyEmptyMessage="notifyEmptyMessage"
        v-on:emitNotificationDeleteMessage="listenDeleteMessage"
        v-on:emitNotifyEmptyMessage="listenNotifyEmptyMessage"
    >
    </ChildComponent>
  </div>
</template>

<style>

</style>

<script>
  import Child from './Child.vue';

  export default {
    data() {
      return {
        message: '',
        listMessage: [],
        countListMessage: -1,
        notification: '',
        notifyEmptyMessage: false,
      };
    },
    components: {
      ChildComponent: Child
    },
    methods: {
      addMessage() {
        if (this.message) {
          this.listMessage.push(this.message);
          this.message = '';
          this.countListMessage = this.listMessage.length;
          this.notifyEmptyMessage = false;
        } else {
          alert('Nothing happened');
        }
      },
      listenDeleteMessage(message) {
        this.notification = message;
      },
      listenNotifyEmptyMessage(value) {
        this.notifyEmptyMessage = value;
      }
    }
  }
</script>