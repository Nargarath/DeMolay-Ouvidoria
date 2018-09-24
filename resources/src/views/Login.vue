<template>
    <section class="section-hero section-shaped my-0">
        <div class="shape shape-style-1 shape-primary">
            <span class="span-150"></span>
            <span class="span-50"></span>
            <span class="span-50"></span>
            <span class="span-75"></span>
            <span class="span-100"></span>
            <span class="span-75"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
        </div>
        <div class="container shape-container d-flex align-items-center">
            <div class="col px-0">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 text-center pt-lg">
                        <card type="secondary" shadow
                            header-classes="bg-white pb-5"
                            body-classes="px-lg-5 py-lg-5"
                            class="border-0">
                            <template>
                                <form role="form">
                                    <div v-bind:class="['alert' ,success?'alert-success':'alert-danger' ,'alert-dismissible', 'fade', 'show']" role="alert" v-if="success!==''">
                                        <span class="alert-inner--icon"><i v-bind:class="['fa', success?'fa-check-circle':'fa-exclamation-circle']"></i></span>
                                        <span class="alert-inner--text">{{errors.message}}</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="success=''">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div v-bind:class="['form-group', 'mb-3', 'input-group', 'input-group-alternative',errors.identity!=''&&!success?'has-danger':'',success?'has-success':'']">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="ni ni-email-83"></i>
                                            </span>
                                        </div> 
                                        <input aria-describedby="addon-right addon-left" v-model="data.identity" placeholder="Email" v-bind:class="['form-control',errors.identity!=''&&!success?'is-invalid':'',success?'is-valid':'']">
                                    </div>
                                    
                                   <div v-bind:class="['form-group', 'input-group', 'input-group-alternative',errors.password!=''&&!success?'has-danger':'',success?'has-success':'' ]">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">
                                               <i class="ni ni-lock-circle-open"></i>
                                            </span>
                                        </div>
                                        <input aria-describedby="addon-right addon-left" v-model="data.password" type="password" placeholder="Senha" v-bind:class="['form-control',errors.password!=''&&!success?'is-invalid':'',success?'is-valid':'']">    
                                    </div>
                                    <div class="custom-control custom-checkbox default">
                                        <input id="9b6a294f17359" type="checkbox" class="custom-control-input" v-model="data.remember">
                                        <label for="9b6a294f17359" class="custom-control-label" >
                                            Lembrar-me
                                        </label>
                                    </div>

                                    <div class="text-center">
                                        <base-button type="default" v-on:click="login()" class="my-4">Entrar</base-button>
                                    </div>
                                </form>
                            </template>
                        </card>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="#" class="text-white">
                                    <small>Esqueceu a senha?</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-around stars-and-coded">
                    <div class="col-sm-4">
                        <span class="text-white alpha-7 ml-3">Colabore com o projeto no</span>
                        <a href="https://github.com/Nargarath/DeMolay-Ouvidoria" target="_blank" title="Support us on Github">
                            <img src="assets/img/brand/github-white-slim.png" style="height: 22px; margin-top: -3px">
                        </a>
                    </div>
                    <div class="col-sm-4 mt-4 mt-sm-0 text-right">
                        <span class="text-white alpha-7">Coded by</span>
                        <a href="https://github.com/Nargarath" style="color:white;" target="_blank">
                            Mateus de M. Cordeiro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from "axios";
export default {
        
    mounted(){
    },
    created(){
    },
    data() {
        return{
            data:{
                identity:'',
                password:'',
                remember:false
            },
            success:'',
            errors:{
                identity:'',
                password:'',
                message:''
            }

        }
    },
    methods:{
        login(){
            var data = new FormData();
            data.append('identity', this.data.identity);
            data.append('password', this.data.password);
            data.append('remember', this.data.remember);
            axios.post('auth/login',data)
                .then((res)=>{

                    if(!res.data.success){
                        this.success = res.data.success;
                        this.errors.message = res.data.message!=undefined?res.data.message:'';
                        this.errors.identity = res.data.errors.identity!=undefined?res.data.errors.identity:'';
                        this.errors.password = res.data.errors.password!=undefined?res.data.errors.password:'';
                        
                    }else{
                        this.$root.$emit('status-login-changed');
                        this.success = res.data.success;
                        this.errors.message = res.data.message;
                        window.sessionStorage.setItem('logged_in',true);
                        this.$router.push({ name: 'admin'});
                    }
                    
                })
                .catch((err)=>{

                })
        },
    }
};
</script>
<style>
</style>