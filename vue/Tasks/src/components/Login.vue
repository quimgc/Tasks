<template>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form @submit.prevent="submit" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" v-model="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" v-model="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    </body>
</template>

<script>
  import axios from 'axios'
  export default {
    name: 'Example',
    data () {
      return {
        email: '',
        password: ''
      }
    },
    mounted () {
      console.log('Mounted ok')
    },

    methods: {
      submit () {
        axios.post('http://localhost:8081/oauth/token', {
          'grant_type': 'password',
          'client_id': 2,
          'client_secret': 'jxKEmfJSrT6CB4DbqougBbN8oQUTM29ecVmJ1kX4',
          'username': this.email,
          'password': this.password
        }).then(response => {
          console.log('HEY!!!!!!!')
          console.log(response)
          console.log(response.data)
        }).catch(error => {
          console.log('ERROR:' + error)
          console.log('SHIT!!!!!!!!!!!!!')
        })
      }
    }
  }

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>

</style>
