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
                        <h2 class="display-3 text-white">Capitulos</h2>
                        <p class="lead text-white">
                           
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <button type="button" class="btn btn-icon btn-secondary"><i class="fa fa-plus"></i></button>
                            <filterbar></filterbar>
                            <vuetable ref="vuetable"
                                :api-url="'admin/chapter/datatable'"
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
import BootstrapStyle from '../datatable/bootstrap-css.js';
import filterbar from '../datatable/FilterBar.vue';
export default {
     components: {
        filterbar,

    },
    mounted(){
        this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
    },
    data () {
        return {
            css: BootstrapStyle,
            fields: [
                {
                name:'name',
                sortField: 'name',
                title: 'Nome',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name:'number',
                sortField: 'number',
                title: 'Nº',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name:'region',
                sortField: 'region',
                title: 'Região',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name:'emblem',
                sortField: 'emblem',
                title: 'Emblema',
                callback: 'emblem',
                titleClass: 'text-center',
                dataClass: 'text-center'
                },
                {
                name: '__component:chapter-actions',   // <----
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
        emblem(value){
            return "<img src="+'assets/img/caps/'+value+" class='rounded-circle' style='width:50px;height:50px;margin: 0;z-index:3; opacity:0.8;'>";
        }

    }
};
</script>