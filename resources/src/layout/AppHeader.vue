<template>
    <header class="header-global">
        <base-nav class="navbar-main" transparent type="" effect="light" expand>
            <router-link slot="brand" class="navbar-brand mr-lg-5" tag="a" to="/">
                <img src="assets/img/brand/white.png" style="width: 100px;height:50px;">
            </router-link>



            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">

            </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/DeMolayRN/" target="_blank"
                       data-toggle="tooltip" title="Curta nossa página no Facebook!">
                        <i class="fa fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.instagram.com/demolaypotiguar/"
                       target="_blank" data-toggle="tooltip" title="Siga-nos no Instagram!">
                        <i class="fa fa-instagram"></i>
                        <span class="nav-link-inner--text d-lg-none">Instagram</span>
                    </a>
                </li>
                <router-link class="nav-item d-lg-block ml-lg-4 " tag="li" v-bind:to="!this.$root.$data.user.logged_in?'/login':'/admin'" >
                    <button  target="_blank"
                        class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon">
                                <i class="fa fa-user-times mr-2 text-darker"></i>
                            </span>
                            <span class="nav-link-inner--text text-darker">Área Restrita</span>
                    </button>
                </router-link>
                <li class="nav-item d-lg-block ml-lg-4 " v-if="this.$root.$data.user.logged_in">
                    <button  target="_blank"
                        class="btn btn-secondary btn-icon" @click="logout()">
                            <span class="btn-inner--icon">
                                <i class="fa fa-sign-out mr-2 text-darker"></i>
                            </span>
                            <span class="nav-link-inner--text text-darker">Logout</span>
                    </button>
                </li>
                    
            </ul>
        </base-nav>
    </header>
</template>
<script>
import axios from "axios";
import BaseNav from "../components/BaseNav.vue";
import BaseDropdown from "../components/BaseDropdown.vue";
import CloseButton from "../components/CloseButton.vue";

export default {
    components: {
        BaseNav,
        CloseButton,
        BaseDropdown
    },
    data(){
        return{
        }
    },
    created(){
        this.verifyLogin();
    },
    mounted(){
        this.$root.$on('status-login-changed', e => this.verifyLogin());  
    },
    methods: {
        logout(){
            axios.get('auth/logout')
                .then((res)=>{
                    this.$router.push({ name: 'ouvidoria_init'});                    
                    this.verifyLogin();
                })
                .catch((err)=>{

                })
        },
        verifyLogin(){
            axios.get('auth/logged_in')
            .then((res)=>{
              this.$root.$data.user = res.data;
              window.sessionStorage.setItem('logged_in',res.data.logged_in);
              
          })
          .catch((err)=>{

          })
    },
    }
};
</script>
<style>
</style>
