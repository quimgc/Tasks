<template>

  <body>
      <div class="container">

        <main>

          <section class="content-header"> CONTENT HEADER</section>
          <!--<section><router-view/></section>-->

        </main>

        <aside class="left_sidebar" :class="{ isOpen: menuOpen }"></aside>
        <aside class="right_sidebar">Right sidebar</aside>

        <footer>FOOTER</footer>

        <header>

          <i class="da fa-address-card"></i>
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </header>
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
    padding: 1.25em;

  }

  main {

    background-color: #ecf0f5;
    grid-row: 2;
    grid-column: 2;

  }

  header {

    background-color: #377fa9;

    grid-row: 1;
    grid-column: 1;

    grid-column-start: 1;
    grid-column-end: 4;

  }

  .content-header {

  background-color: white;
  }

  footer {

    background-color: #ffffff;
    grid-row: 3;
    grid-column-start: 1;
    grid-column-end: 4;
  }

  section {

    background-color: #ecf0f5;

  }

  .left_sidebar {
    grid-row: 2;
    grid-column: 1;
    background-color: #222d33;

  }

  .right_sidebar {

    grid-row: 2;
    grid-column: 3;
    background-color: #ecf0f5;

  }


  /* Responsive */

  @media (max-width: 400px) {
    .container {

      display: block;

    }
  }


</style>
