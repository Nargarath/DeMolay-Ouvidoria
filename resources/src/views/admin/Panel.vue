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
                    <div class="col-lg-12 text-center pt-lg">
                        <h2 class="text-white display-2">Bem-vindo,{{this.$root.$data.user.data.first_name!==undefined?this.$root.$data.user.data.first_name:''}}</h2>
                        <p class="lead text-white ">O que deseja administrar agora?</p>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center stars-and-coded">
                    <div class="col-lg-12 text-center">
                        <div class="btn-wrapper">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-12">
                                    <div class="btn-group btn-group-lg">
                                        <button class="btn btn-secondary btn-icon btn-block" >
                                            <span class="btn-inner--icon">
                                                <i class="fa fa-gavel "></i>
                                            </span>
                                            <span class="btn-inner--text">Capitulos</span>
                                        </button>
                                        <button class="btn btn-secondary btn-icon btn-block" style="margin-top:0 !important;">
                                            <span class="btn-inner--icon">
                                                <i class="ni ni-single-copy-04 "></i>
                                            </span>
                                            <span class="btn-inner--text">Feedbacks</span>
                                            
                                        </button>
                                        <button class="btn btn-secondary btn-icon btn-block" style="margin-top:0 !important;" >
                                            <span class="btn-inner--icon">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            <span class="btn-inner--text">Usuários</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
};
</script>
<style>
</style>
