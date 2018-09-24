 <style>
  .actions{
      padding: 10px 15px !important;
  }
 </style>
 <template>
    <div class="custom-actions">
      <button v-bind:class="['btn', (rowData.approved=='1')?'btn-danger':'btn-success', 'actions']" @click="changeStatus(rowData, rowIndex)"><i v-bind:class="['fa', (rowData.approved=='1')?'fa-times':'fa-check']"></i></button>
      <button class="btn btn-info actions" @click="itemAction('edit-item', rowData, rowIndex)"><i class="fa fa-pencil"></i></button>
      <button class="btn btn-danger actions" @click="del(rowData, rowIndex)"><i class="fa fa-trash-o"></i></button>
    </div>
  </template>

  <script>
  import axios from "axios";
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
      changeStatus(data, index){
        axios.get('admin/feedback/change_status/'+data.id)
                .then((res)=>{
                    this.$events.fire('refresh-feedback')
                })
                .catch((err)=>{

                })
      },
      del(data, index){
            axios.get('admin/feedback/delete/'+data.id)
                .then((res)=>{
                    this.$events.fire('refresh-feedback')
                })
                .catch((err)=>{

                })
      },
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