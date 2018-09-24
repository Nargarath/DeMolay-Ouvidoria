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
                        <h2 class="display-3 text-white">Usuários</h2>
                        <p class="lead text-white">
                           
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <button type="button" class="btn btn-icon btn-secondary" @click="modals.modal0 = true"><i class="fa fa-plus"></i></button>
                            <filterbar></filterbar>
                            <vuetable ref="vuetable"
                                :api-url="'admin/user/datatable'"
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
        <modal :show.sync="modals.modal0">
            <template slot="header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário</h5>
            </template>
            <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-12">
                            <div v-bind:class="['alert' ,success?'alert-success':'alert-danger' ,'alert-dismissible', 'fade', 'show']" role="alert" v-if="success!==''">
                                <span class="alert-inner--icon"><i v-bind:class="['fa', success?'fa-check-circle':'fa-exclamation-circle']"></i></span>
                                <span class="alert-inner--text">{{errors.message}}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="success=''">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <base-input :type="'text'" placeholder="Nome ou Apelido" addon-left-icon="fa fa-user" v-model="user.name" :valid="validName" block></base-input>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <base-input :type="'text'" placeholder="Email" addon-left-icon="fa fa-envelope" v-model="user.email" :valid="validEmail" block></base-input>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <base-input :type="'password'" placeholder="Senha" addon-left-icon="fa fa-key" v-model="user.pass" :valid="validPass" block></base-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <base-input :type="'password'" placeholder="Confirme a senha" addon-left-icon="fa fa-key" v-model="user.cpass" :valid="validCPass" block></base-input>
                        </div>
                    </div>

                </div>
                
            </div>
            </div>
            <template slot="footer">
                <base-button type="default" block @click="Register()" >Realizar Cadastro</base-button>
            </template>
        </modal>
    </div>
</template>


<script>
import BootstrapStyle from '../datatable/bootstrap-css.js'
import filterbar from '../datatable/FilterBar3.vue';
import modal from '../../components/Modal.vue';
import BaseInput from '../../components/BaseInput.vue';
import axios from "axios";

export default {
    components: {
        filterbar,
        modal,
        BaseInput
    },
    watch:{
        success: function(val){
            if(val===''){
                if(errors.message!=''||errors.name!=''||errors.email!=''||errors.pass!=''||errors.cpass!=''){
                    this.successChange = val;
                }else{
                    this.successChange = undefined;
                }
            }else if(val||!val){
                if(this.errors.name!=''){
                    this.validName = false;
                }else{
                    this.validName = true;
                }
                if(this.errors.email!=''){
                    this.validEmail = false;
                }else{
                    this.validEmail = true;
                }
                if(this.errors.pass!=''){
                    this.validPass = false;
                }else{
                    this.validPass = true;
                }
                if(this.errors.cpass!=''){
                    this.validCPass = false;
                }else{
                    this.validCPass = true;
                }
            }
        },
    },
    mounted(){
        this.$events.$on('filter-set3', eventData => this.onFilterSet(eventData))
        this.$events.$on('refresh-users', eventData => this.refresh())
    },
    data () {
        return {
            css: BootstrapStyle,
            fields: [
                {
                name:'first_name',
                sortField: 'first_name',
                title: 'Nome'
                },
                {
                name:'username',
                sortField: 'username',
                title: 'E-mail'
                }
            ],
            moreParams: {},
            modals:{
                modal0:false
            },
            user:{
                name:'',
                email:'',
                pass:'',
                cpass:''

            },
            success:'',
            errors:{
                message:'',
                name:'',
                email:'',
                pass:'',
                cpass:''
            },
            successChange:undefined,
            validName:undefined,
            validEmail:undefined,
            validPass:undefined,
            validCPass:undefined
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
        Register(){
            var data = new FormData();
            data.append('name', this.user.name);
            data.append('email', this.user.email);
            data.append('password', this.user.pass);
            data.append('cpassword', this.user.cpass);
            axios.post('admin/user/add',data)
                .then((res)=>{
                    if(!res.data.success){
                        this.success = res.data.success;
                        this.errors.message = res.data.message!=undefined?res.data.message:'';
                        this.errors.name = res.data.errors.name!=undefined?res.data.errors.name:'';
                        this.errors.email = res.data.errors.email!=undefined?res.data.errors.email:'';
                        this.errors.pass = res.data.errors.password!=undefined?res.data.errors.password:'';
                        this.errors.cpass = res.data.errors.cpassword!=undefined?res.data.errors.cpassword:'';
                    }else{
                        this.user.message = '';
                        this.user.name = '';
                        this.user.email = '';
                        this.user.pass = '';
                        this.user.cpass = '';
                        this.successChange = undefined,
                        this.validName = undefined,
                        this.validEmail = undefined,
                        this.validPass = undefined,
                        this.validCPass = undefined
                        this.success = res.data.success;
                        this.errors.message = res.data.message;
                        this.refresh();
                    }
                })
                .catch((err)=>{

                })
        },
        refresh(){
            this.$refs.vuetable.refresh()
        },
    }
};
</script>