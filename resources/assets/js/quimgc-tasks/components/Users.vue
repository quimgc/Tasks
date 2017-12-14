<template>
    <div>

        <multiselect track-by="id" @select="select" :id="id" :name="name" v-model="user" :options="users" :custom-label="customLabel"></multiselect>

    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>

    import axios from 'axios'
    import Multiselect from 'vue-multiselect'


  export default {
    components: { Multiselect },
    name: 'users',
    data () {
      return {
        user: null,
        users: [],
      }
    },
    props: ['id','name','value'],
    computed: {
      numUsers() {
        return this.users.length
      }

  },
    watch: {
      value(newValue) {
        console.log('newValue: ' + newValue);
        this.user = this.users.find(user => {
          return user.id == newValue;
        });
      }
    },

    methods: {
      select(user) {
        this.$emit('select',user);
      },
      customLabel( user ){
        return `${user.name} - ${user.email}`
      }

    },

    mounted () {
      //Les promises són codi asincron.
      axios.get('api/v1/users').then( (response)=>{
            this.users = response.data
        this.user = this.users.find(user => {
          return user.id == this.value;
        });
        }

      ).catch( error => {

        console.log(error)

      }).then()

    }
  }
</script>