<template>
  <div>
      <v-card v-for="task in tasks">
        <v-card-media :src="task.image" height="200px" class="mb-1">
        </v-card-media>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">{{task.name}}</h3>
            <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-btn flat color="orange">Share</v-btn>
          <v-btn flat color="orange">Explore</v-btn>
        </v-card-actions>
      </v-card>
  </div>
</template>

<style>
</style>

<script>
  import { mapGetters } from 'vuex'
  import * as actions from '../store/action-types'

  export default {
    name: 'Tasks',
    computed: {
      ...mapGetters(['tasks'])
    },
    mounted () {
      this.$store.dispatch(actions.FETCH_TASKS)
    }
  }
</script>
