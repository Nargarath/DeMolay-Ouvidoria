<template>
    <div class="position-relative">
        <section class="section section-shaped my-0 overflow-hidden" id="mural">
            <div class="shape shape-style-3 bg-gradient-default shape-skew ">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container pt-lg pb-300">
                <div class="row text-center justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="display-3 text-white">Feedbacks</h2>
                        <p class="lead text-white">
                           
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <filterbar></filterbar>
                            <vuetable ref="vuetable"
                                :api-url="'admin/feedback/datatable'"
                                :css="css"
                                :fields="fields"
                                pagination-path=""
                                :per-page="10"
                                :multi-sort="true"
                                :append-params="moreParams"
                                @vuetable:cell-clicked="onCellClicked"
                                @vuetable:pagination-data="onPaginationData"
                            ></vuetable>
                            <div style="background-color: white;display: flex;padding: 1em;margin-top: -1em;">
                                <vuetable-pagination-info ref="paginationInfo"
                                    :css="css.pagination"
                                    info-class="pull-left"
                                ></vuetable-pagination-info>
                            
                                <vuetable-pagination ref="pagination"
                                    :css="css.pagination"
                                    @vuetable-pagination:change-page="onChangePage"
                                ></vuetable-pagination>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import BootstrapStyle from '../datatable/bootstrap-css.js'
import filterbar from '../datatable/FilterBar2.vue';
import CustomActions from '../datatable/actionsFeedback.vue';

export default {
    components: {
        filterbar,
        'custom-actions': () => CustomActions
        
    },
    mounted(){
        this.$events.$on('filter-set2', eventData => this.onFilterSet(eventData))
        this.$events.$on('refresh-feedback', eventData => this.refresh())
    },
    data () {
        return {
            css: BootstrapStyle,
            fields: [
                {
                name:'text',
                sortField: 'text',
                title: 'Texto',
                titleClass: 'text-center',
                },
                {
                name:'feedbackType_id',
                sortField: 'feedbackType_id',
                title: 'Tipo',
                callback: 'feedbackType',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name:'approved',
                sortField: 'approved',
                title: 'Aprovada',
                callback: 'approved',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name:'created_at',
                sortField: 'created_at',
                titleClass: 'text-center',
                title: 'Recebida'
                },
                {
                name: '__component:feedback-actions',   // <----
                title: 'Ações',
                titleClass: 'text-center',
                dataClass: 'text-center'
                }
            ],
            moreParams: {}

        }
        
    },
    methods: {
        onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfo.setPaginationData(paginationData)
        },
        onChangePage (page) {
            this.$refs.vuetable.changePage(page)
        },
        onCellClicked (data, field, event) {
            console.log('cellClicked: ', field.name)
            this.$refs.vuetable.toggleDetailRow(data.id)
        },
        onFilterSet (filterText) {
            this.moreParams = {
                    'filter': filterText
            }
            this.$nextTick( () => this.$refs.vuetable.refresh())
        },
        onFilterReset () {
            this.moreParams = {}
            this.$nextTick( () => this.$refs.vuetable.refresh())
        },
        refresh(){
            this.$refs.vuetable.refresh()
        },

        feedbackType(value){
            if(value=='1'){
                return "<i class='ni ni-like-2 text-default' data-toggle='tooltip' data-placement='top' title='Elogio' ></i>";
            }else if(value=='2'){
                return "<i class='ni ni-bulb-61 text-default' data-toggle='tooltip' data-placement='top' title='Sugestão' ></i>";
            }else if(value=='3'){
                return "<i class='fa fa-thumbs-down text-default' data-toggle='tooltip' data-placement='top' title='Crítica' ></i>";
            }else if(value=='4'){
                return "<i class='fa fa-comments text-default' data-toggle='tooltip' data-placement='top' title='Pergunta' ></i>";
            }
        },
        approved(value){
            if(value=='0'){
                return "<i class='fa fa-times text-default' data-toggle='tooltip' data-placement='top' title='Reprovada' ></i>";
            }else if(value=='1'){
                return "<i class='fa fa-check text-default' data-toggle='tooltip' data-placement='top' title='Aprovada' ></i>";
            }
        }

    }
};
</script>