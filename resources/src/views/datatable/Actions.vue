 <template>
    <div class="custom-actions">
      <router-link  class="ui basic button" tag="button" :to="{ name: 'emprestimoModule.emprestimo.people', params: { id: rowData.id }}" v-scroll-to="'#router-view'">
           <i class="zoom icon"></i>
      </router-link>

    </div>
  </template>

  <script>
  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      itemAction (action, data, index) {
        console.log('custom-actions: ' + action, data, index)
      }
    }
  }
  </script>

  <style>
    .custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>
