<template>
    <div>

        <multiselect v-model="user" :options="users" :custom-label="customLabel"></multiselect>

    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>

    import axios from 'axios'
    import Multiselect from 'vue-multiselect'


  export default {
    components: { Multiselect },

    name: 'name',
    data () {
      return {
        user: null,
        users: [],
      }
    },
    computed: {
      numUsers() {
        return this.users.length
      }

  },

    methods: {
      customLabel( user ){
        return `${user.name} - ${user.email}`
      }

    },

    mounted () {
      console.log('Mounted ok')


      //Les promises són codi asincron.

      axios.get('api/v1/users').then( (response)=>{
            this.users = response.data
        }

      ).catch( error => {

        console.log(error)

      }).then()


    }
  }
</script>