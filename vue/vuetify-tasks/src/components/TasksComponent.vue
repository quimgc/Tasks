<template>
    <div>
    </div>
</template>

<style>

</style>

<script>

import { mapGetters } from 'Vuex'
import * as actions from '../store/action-types'

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
    this.$store.dispatch(action.)
  }
}
</script>