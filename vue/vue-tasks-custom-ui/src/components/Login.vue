<template>
    <div class="login">
        <div class="logo">
            <p><b>Admin</b>LTE</p>
        </div>

        <div class="login-box">

                <p class="login-box-msg"> Sign in to start your session </p>

            <div class="form-box">
                <form action="">

                    <div class="form-input-email">
                        <input type="email">
                    </div>

                    <div class="form-input-password">
                        <input type="password">
                    </div>

                    <div class="form-buttons">
                        <input type="checkbox">
                        <input type="submit" value="Sign In">
                    </div>

                </form>
            </div>
            <div class="links">

                <a href="#">I forgot my password</a>
                <br>
                <a href="#">Register a new membership</a>

            </div>

        </div>


    </div>
</template>

<style>

    body {

        background-color: #d2d6de;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Source Sans Pro', 'Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif';

    }


    /*logo*/
    .logo > p {
        font-size: 35px;
        font-weight: lighter;
        color: #444;
    }


    .logo > p > b {
        font-weight:900;
    }

    /*fi logo*/

    .login-box {

        background-color: #fff;

    }

    .login-box-msg {

        margin: 1em;
        text-align: center;
        padding: 20px;
    }

    /*formulari login*/

    .form-input-email, .form-input-password {

        padding: 1em;
    }

    .form-buttons {
        display: flex;
        padding: 1em;
        justify-content: space-between !important;
    }

    /*fi formulari login*/

    .links {
        display: block;
        padding: 1em;
        text-align: left;

    }

    .links > a{
        text-decoration: none;
        font-size: 14px;
        color: #337ab7;
    }

</style>

<script>
export default {
  name: 'name',
  data () {
    return {
      data: 'example'
    }
  },
  mounted () {
    console.log('Mounted ok')
  }
}
</script>
