<template>
    <body>
    <div class="container">
        <header>
            <b>Admin</b>LTE
        </header>
        <nav class="header-nav">
            <a href="">
                <svg @click="toogleSideBar" class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </a>
            <ul>
                <li>
                    <a href="#Emails">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/></svg>
                    </a>
                </li>
                <li>
                    <a href="#Notification">Notifications</a>
                </li>
                <li>
                    <a href="#Tasks">Tasks</a>
                </li>
                <li>
                    <a href="#Profile"><img class="avatar" src="https://s.gravatar.com/avatar/dbaecaa06631717debc0e25529ca14f4?s=80" alt="Quim González Colat"> Quim González Colat</a>
                </li>
                <li>
                    <a href="#Preferences">Preferences</a>
                </li>
            </ul>
        </nav>
        <main>
            <section class="content-header">CONTENT HEADER</section>
            <section><router-view/></section>
        </main>

        <aside class="left_sidebar" :class="{ isOpen: menuOpen }">
            <div class="user-panel">
                <div>
                    <img class="avatar" src="https://s.gravatar.com/avatar/dbaecaa06631717debc0e25529ca14f4?s=80" alt="Quim González Colat">
                </div>
                <div>
                    <p>Quim González Colat</p>
                    <svg height="14" width="14">
                        <circle cx="7" cy="7" r="5" stroke="#3d763e" stroke-width="1" fill="#3d763e" />
                    </svg>
                    Online
                </div>
            </div>
            <form action="">
                <input type="text" placeholder="Search">
                <button type="submit">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
            <nav class="main-menu">
                <ul>
                    <li class="header">Main menu</li>
                    <li><a href="#dashboard">
                        <svg class="icon-menu"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"/></svg>
                        Dashboard</a>
                        <ul>
                            <li> Prova</li>
                            <li> Prova2</li>
                        </ul>

                    </li>



                    <li>
                        <a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 6V2c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-4v4a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h4zm2 0h4a2 2 0 0 1 2 2v4h4V2H8v4zM2 8v10h10V8H2z"/></svg>
                            Layout Options </a>
                    </li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 0h9v9H0V0zm2 2v5h5V2H2zm-2 9h9v9H0v-9zm2 2v5h5v-5H2zm9-13h9v9h-9V0zm2 2v5h5V2h-5zm-2 9h9v9h-9v-9zm2 2v5h5v-5h-5z"/></svg>
                        Widgets</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M19.95 11A10 10 0 1 1 9 .05V11h10.95zm-.08-2.6H11.6V.13a10 10 0 0 1 8.27 8.27z"/></svg>
                        Charts</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 16h2v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-1h2V4c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v12zM4 4v9h12V4H4zm4 11v1h4v-1H8z"/></svg>
                        UI Elements</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 4v14h14v-6l2-2v10H0V2h10L8 4H2zm10.3-.3l4 4L8 16H4v-4l8.3-8.3zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                        Forms</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 2h4v15a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V0h16v2zm0 2v13a1 1 0 0 0 1 1 1 1 0 0 0 1-1V4h-2zM2 2v15a1 1 0 0 0 1 1h11.17a2.98 2.98 0 0 1-.17-1V2H2zm2 8h8v2H4v-2zm0 4h8v2H4v-2zM4 4h8v4H4V4z"/></svg>
                        Tables</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg>
                        Calendar</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                        Mailbox</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h7l2 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 2v10h16V6H2z"/></svg>
                        Examples</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 7H2v6h8v5l8-8-8-8v5z"/></svg>
                        Multilevel</a></li>
                    <li><a href="#tasques">
                        <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/></svg>
                        Documentation</a></li>
                    <li class="header">LABELS</li>
                    <li><a href="#tasques">Important</a></li>
                    <li><a href="#tasques">Warning</a></li>
                    <li><a href="#tasques">Information</a></li>
                    <li class="premiumTemplates"><a href="#tasques">Premium Templates</a></li>

                </ul>
            </nav>
        </aside>
        <aside class="rigth_sidebar">Rigth Sidebar</aside>

        <footer>FOOTER</footer>
    </div>
    </body>
    <!--https://codepen.io/oknoblich/pen/klnjw-->
</template>

<script>
  export default {
    name: 'app',
    data () {
      return {
        menuOpen: false
      }
    },
    methods: {
      toogleSideBar () {
        this.menuOpen = !this.menuOpen
      }
    }
  }
</script>

<style>


    html, body, .container {
        margin: 0;
        height: 100%;
    }

    body {
        font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';
        font-weight: 400;
        font-size: 14px;
        line-height: 1.42857143;
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

    .icon, .icon-menu {
        display: inline-block;
        fill: currentColor;
    }

    .icon {

        height: 1.25em;
        width: 1.25em;
    }

    .icon-menu {

        height: 1em;
        width: 1em;
        margin-right: 0.5em;


    }



    .container {
        display: grid;
        grid-template-columns: 200px 1fr 200px;
        grid-template-rows: 50px 1fr 50px;
    }

    header {
        color: white;
        background-color: #367fa9;
        grid-row: 1;
        grid-column: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        /*ALTERNATIVE TO CENTER:*/
        /*margin: auto;*/
        /*height: 100%;*/
        /*width: 100%;*/
        font-size: 20px;
    }

    header:hover {
        cursor:pointer;
        background-color: #357ca5;
    }

    footer {
        background-color: white;
        grid-row: 3;
        grid-column:2/4;
    }
    main {
        background-color: #ecf0f5;
        grid-row: 2;
        grid-column: 2;
    }
    aside {
        color: white;
        background-color: #222d32;
    }
    .content-header { background-color: #d2d6de; }

    /*OFF CANVAS*/
    /*.left_sidebar {*/
    /*position: fixed; !* or choose `absolute` depending on desired behavior*!*/
    /*top: 0;*/
    /*bottom: 0;*/
    /*width: 200px;*/
    /*left: -200px;*/
    /*transition: left .3s ease-in-out;*/
    /*grid-row: 2;*/
    /*grid-column-start: 1;*/
    /*grid-column-end: 1;*/
    /*}*/

    /*.left_sidebar.isOpen {*/
    /*transform: translate3d(200px,0,0);*/
    /*}*/

    .left_sidebar {
        grid-row: 2/4;
        grid-column: 1;
    }

    .user-panel {
        padding: 10px;
        /*border: 1px solid black;*/
        /*background-color: white;*/
        /*color: #111;*/
        display:flex;
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

    .left_sidebar ul {
        margin: 0;
        background-color: #2d3c42;
        display: flex;
        flex-direction: column;
        /*border: 1px solid black;*/
    }

    .left_sidebar ul li a {
        /*border: 1px solid black;*/
        background-color: #2d3c42;
        display: block;
        padding: 12px 15px;
    }

    .left_sidebar ul li.header {
        /*border: 1px solid black;*/
        color: #4b646f;
        background: #1a2226;
        text-transform: uppercase;
        font-size: 12px;
        padding: 12px 15px;
        cursor: auto;
    }

    .left_sidebar ul li a:hover {
        background-color: #222d32;
    }

    .rigth_sidebar {
        grid-row: 2;
        grid-column: 3;
    }

    ul, li {
        list-style: none;
    }

    ul {
        margin: 0;
        padding: 0;
    }

    .header-nav {
        grid-row: 1;
        grid-column: 2/4;
        background-color: #3c8dbc;
        color: #fff;
        display: flex;
    }

    .header-nav>a {
        padding: 0.5rem;
        /*margin-right: auto; !** PULL-LEFT **!*/
        height: 100%;
        display: flex;
        align-self: center;
        align-items: center;
    }

    .header-nav ul {
        display: flex;
        margin: 0px 0px 0px auto;
    }

    .header-nav ul li {
        height: 100%;
        display: flex;
        align-items: center;
    }

    .header-nav ul li a {
        padding: 12px 15px 12px 15px;
        display:flex;
        align-items: center;
    }

    .header-nav ul li:hover, .header-nav>a:hover {
        background-color: #367fa9;
    }

    /*Menú desplegable*/

    .main-menu ul li > ul {
        display: none;
        transition: width 2s;

    }
    .main-menu ul li:hover > ul {
        display:block;
    }
    /* Fi Menú Desplegable*/

    /* Responsive */

    @media (max-width: 400px) {
        .container {
            display: block;
        }
    }

</style>
