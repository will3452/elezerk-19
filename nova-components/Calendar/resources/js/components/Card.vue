<template>
  <Card class="flex flex-col items-center justify-center">
    <Calendar is-expanded :attributes="attrs"/>
  </Card>
</template>

<script>
export default {
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    this.attrs = []
    const events = this.card.events.map(event => ({... event, key: event.id, dot: true, dates: new Date(event.datetime), popover: {
        label: event.name,
    }}))

    this.attrs = this.attrs.concat(events)
  },


  data() {
    return {
        attrs: [
            {
                key: 'today',
                dot: true,
                dates: new Date(),
            }
        ]
    }
  }
}
</script>

<style>
</style>
