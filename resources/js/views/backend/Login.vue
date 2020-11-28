<template>
  <div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
      <h3>Welcome to VUEJS</h3>
      <p>Login in. To see it in action.</p>

      <ErrorValidate :errorsValidate="errorsValidate"/>

      <form class="m-t" role="form" action="">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Enter your email" v-model="admin.adminEmail" required="">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="**********" v-model="admin.adminPassword" required="">
        </div>
        <button type="button" class="btn btn-primary block full-width m-b" @click="login">Login</button>
      </form>
      <p class="m-t">
        <small>Copyright by EnglishNow Global @2020</small>
      </p>
    </div>
  </div>
</template>

<script>
  import ErrorValidate from "./includes/ErrorValidate.vue";

  export default {
    components: {
      ErrorValidate
    },
    data() {
      return {
        errorsValidate: [],
        admin: {
          adminEmail: '',
          adminPassword: '',
        },
        loading: {
          processing: false
        },
      };
    },

    methods: {
      login() {
        showLoading();
        this.axios.post('/api/login', this.admin)
          .then((response) => {
            if (ajaxOk(response)) {
              setLocalStorage('__CONFIG__', JSON.stringify(response.data.data));
              hideLoading();
              return this.$router.push({name: 'Dashboard'});
            }
            this.errorsValidate = response.data.message;
            hideLoading();
          })
          .catch((error) => {
            console.log('Error');
          });
      },
    },
  }
</script>

<style></style>
