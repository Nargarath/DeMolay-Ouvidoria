<template>
  <div class="form-inline float-right mb-1">
    <div class="form-group">
      <input type="text" v-model="filterText" class="form-control" @keyup="doFilter" placeholder="Procurar">
    </div>

  </div>
</template>

  <script>
  export default {
    data () {
      return {
        filterText: ''
      }
    },
    methods: {
        doFilter () {
            this.$events.fire('filter-set2', this.filterText)
        },
        resetFilter () {
            this.filterText = ''  // clear the text in text input
            this.$events.fire('filter-reset2')
        }
    }
  }
</script>
