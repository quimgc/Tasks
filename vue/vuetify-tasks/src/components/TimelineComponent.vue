<template>
    <div>
     {{data}}
    </div>
</template>

<style>

</style>

<script>
export default {
  name: 'Timeline',
  props: {
    events: {
      type: Array,
      required: true
    }
  }
}
</script>