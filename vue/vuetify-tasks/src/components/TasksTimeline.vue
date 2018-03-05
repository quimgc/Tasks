<template>

    <div>
        <timeline :events="taskEvents"></timeline>

    </div>
</template>

<style></style>
<script>
  import Timeline from './TimelineComponent.vue'

  export default {

    name: 'TasksTimeline',
    components: { Timeline },
    data () {
      return {
        taskEvents: []
      }
    },
    mounted () {
      this.taskEvents = [
        {
          'time': '12/01/2018 12:45:00',
          'type': 'created',
          'task_name': 'Compra pa',
          'user_name': 'Quim González'
        },
        {
          'time': '12/01/2018 12:45:00',
          'type': 'created',
          'task_name': 'Compra pa',
          'user_name': 'Quim González'
        },
        {
          'time': '12/01/2018 12:45:00',
          'type': 'created',
          'task_name': 'Compra pa',
          'user_name': 'Quim González'
        }
      ]
    }
}
</script>
