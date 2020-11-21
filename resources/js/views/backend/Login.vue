<template>
  <div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
      <h3>Welcome to VUEJS</h3>
      <p>Login in. To see it in action.</p>
      <form class="m-t" role="form" action="">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Enter your email" v-model="user.userEmail" required="">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="**********" v-model="user.userPassword" required="">
        </div>
        <button type="button" class="btn btn-primary block full-width m-b" @click="login">Login</button>

        <!--<a href="javascript:void(0)">-->
        <!--<small>Forgot password?</small>-->
        <!--</a>-->
        <!--<p class="text-muted text-center">-->
        <!--<small>Do not have an account?</small>-->
        <!--</p>-->
        <!--<a class="btn btn-sm btn-white btn-block" href="javascript:void(0)">Create an account</a>-->
      </form>
      <p class="m-t">
        <small>Copyright by EnglishNow Global @2020</small>
      </p>
    </div>
  </div>
</template>

<script>
  export default {
    // name: 'app',
    components: {},

    data() {
      return {
        user: {
          userEmail: '',
          userPassword: '',
        }
      };
    },

    methods: {
      login() {
        console.log('Click post login')
        this.axios.post('/api/login', this.user)
          .then((response) => {
            console.log('Ok');
          })
          .catch((error) => {
            console.log('Error');
          });
      },
    },
  }
</script>

<style>
  body {
    height: 100%;
    background-color: #f3f3f4;
  }
</style>
