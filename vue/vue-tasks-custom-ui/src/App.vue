<template>

  <body>
      <div class="container">
        <header>
    <b>Admin</b>LE
        </header>

          <nav class="header-nav">
            <!--<i class="da fa-address-card"></i>-->
            <a href="">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </a>
            <ul>
              <li><a href="#Emails">Emails</a></li>
              <li><a href="#Notification">Notifications</a></li>
              <li><a href="#Tasks">Tasks</a></li>
              <li><a href="#Profile">Logged User</a></li>
              <li><a href="#Preference">Preferences</a></li>
            </ul>

          </nav>

        <main>

          <section class="content-header"> CONTENT HEADER</section>
          <!--<section><router-view/></section>-->

        </main>

        <aside class="left_sidebar" :class="{ isOpen: menuOpen }">

            <div class="user-panel">

                <!--posar avatarr-->
                Quim González Colat

                <svg height="14" width="14">
                    <circle cx="7" cy="7" r="5" stroke="black" stroke-width="1" fill="#3c773e" />
                </svg>
                Online

            </div>

            <form>

                <input type="text" placeholder="Search">
                <button type="submit">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
            <nav>
                <ul>
                    <li class="header">Main menu</li>
                    <li><a href="#Dashboard">Dasboard</a></li>
                    <li><a href="#Tasques">Tasques</a></li>
                    <li><a href="#Other">Other</a></li>
                    <li>
                        <a href="#Options">Options</a>
                        <ul>
                            <li><a href="#suboption1">suboption1</a></li>
                            <li><a href="#suboption2">suboption2</a></li>
                            <li><a href="#suboption3">suboption3</a></li>
                        </ul>
                    </li>



                    <li><a href="#Header">Header</a></li>
                    <li><a href="#menu1">menu1</a></li>
                    <li><a href="#menu2">menu2</a></li>
                    <li><a href="#menu3">menu3</a></li>
                </ul>


            </nav>

        </aside>
        <aside class="right_sidebar">Right sidebar</aside>

        <footer>FOOTER</footer>


      </div>

  </body>

</template>

<script>
export default {
  name: 'app'
}
</script>

<style>

  html, body, .container {

    margin: 0;
    height: 100%;

  }

  body {

    font-family: 'Source Sans Pro', 'Helvetica Neue', 'Helvetica', 'Arial' ,'sans-serif';
    font-weight: 500;
    font-size: 14px;
    color: #333;
  }

  a {

    text-decoration: none;
    color: inherit;
  }

  .avatar {
    border-radius: 50%;
    height: 40px;
    margin-right: 0.5em;
}

  .container {

    display: grid;
    grid-template-columns: 100px 1fr 100px;
    grid-template-rows: 150px 1fr 100px;

  }

  .icon {
    display: inline-block;
    height: 1.25em;
    width: 1.25em;
    fill: currentColor;
  }

  main, header, footer, aside, section {

    display: grid;
      /*border: solid black 1px;*/
    /*padding: 1.25em;*/

  }

  main {

    background-color: #ecf0f5;
    grid-row: 2;
    grid-column: 2;
  }

  header {
    color: white;
    background-color: #377fa9;
    grid-row: 1;
    grid-column: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  header:hover {

      cursor: pointer;
      background-color: #357ca5;

  }

  .content-header {

  background-color: white;
  }

  footer {

    background-color: #ffffff;
    grid-row: 3;
    grid-column: 2/4;
  }

  section {

    background-color: #ecf0f5;

  }

  .left_sidebar {
    grid-row: 2/4;
    grid-column: 1;
    background-color: #222d33;

  }

  .user-panel {
      display:flex;
      padding: 10px;
      border: 1px;
      font-size: 10px;

  }

  .user-panel p {
      margin: 0;
      font-size: 14px;
      font-weight: 600;
  }

  .left_sidebar form {

      padding: 10px;

  }


  .left_sidebar ul{
        margin: 0;
      padding: 10px;
      background-color: #2d3c42;
      display: flex;
      flex-direction: column;
  }

  .left_sidebar ul li{

      padding: 10px;

  }


  .left_sidebar ul li a{

      background-color: #222d53;
  }

  .left_sidebar ul li:hover {

      color: #4b646f;
      background: #1a2226;
      text-transform: uppercase;
      font-size: 12px;
      padding: 12px 15px;
      cursor: auto;

  }

  .left_sidebar ul li a:hover{

    background-color: #222d53;
  }



  .right_sidebar {

    grid-row: 2;
    grid-column: 3;
    background-color: #222d33;

  }

  ul, li {

    list-style: none;

  }

  nav {

    border: 1px solid black;
    grid-row: 1;
    grid-column: 2/4;
    background-color: #3c8dbb;
    color: #fff;
    display: flex;


  }


  nav>a{

    padding: 0.5em;
    margin-right:auto;
    align-self: center;
    border: 1px solid black;
    height: 100%;
    display: flex;
    align-items: center;
  }

  nav ul {

    display: flex;
    margin: 0px 0px 0px auto;

  }


  nav ul li {
    /*display: flex;*/
    border: 1px solid black;
    height: 100%;
    display: flex;
    align-items: center;

  }


  nav ul li a{

    padding: 12px 15px 12px 15px;
    display: flex;
    align-items:center;
  }


  /* Responsive */

  @media (max-width: 400px) {
    .container {

      display: block;

    }
  }


</style>
