<template>
  <div id="" class="child_component">
    <p class="text-danger"><strong>*** Result</strong></p>
    <table class="table table-bordered">
      <thead>
      <tr>
        <td width="20%">#</td>
        <td>Content</td>
        <td width="20%">Action</td>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(value, key) in propListMessage">
        <td>{{key + 1}}</td>
        <td>{{value}}</td>
        <td><a v-on:click="deleteMessage(key)" class="text-danger">Delete</a></td>
      </tr>
      </tbody>
    </table>

    <p class="text-danger" v-if="propNotifyEmptyMessage"><strong>Hết rồi, chẳng còn gì để xóa</strong></p>
  </div>
</template>

<style>
  .table-bordered tr td {
    background: #fff !important;
  }

  .child_component .table-bordered {
    width: 580px;
  }
</style>

<script>
  export default {
    props: ['propListMessage', 'propNotifyEmptyMessage'],
    data() {
      return {
        listMessageInChild: this.propListMessage,
        notifyEmptyMessage: this.propNotifyEmptyMessage
      }
    },
    watch: {
      // propNotifyEmptyMessage: function (val) { // val là giá trị mới of propNotifyEmptyMessage
      //   this.notifyEmptyMessage = val;
      // },
    },
    methods: {
      deleteMessage(messageId) {
        let contentTmp = this.listMessageInChild[messageId];
        this.listMessageInChild.splice(messageId, 1);
        this.$emit('emitNotificationDeleteMessage', contentTmp);
        if (this.listMessageInChild.length > 0) {
          this.notifyEmptyMessage = false;
        } else {
          this.notifyEmptyMessage = true;
          this.$emit('emitNotifyEmptyMessage', true)
        }
      }
    }
  }
</script>