<template>
    <div>
        <li v-for="task in tasks"> {{ task }}</li>
    </div>
</template>

<style>

</style>

<script>

import { mapGetters, mapMutations } from 'Vuex'

export default {
  name: 'Tasks',
  computed: {
    ...mapGetters(['tasks'])
  },
  data () {
    return {
      data: 'example'
    }
  },
  mounted () {
    console.log('Mounted ok')
    this.$store.dispatch('fetchTasks')
  }
}
</script>