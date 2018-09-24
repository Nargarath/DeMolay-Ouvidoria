<style>
.notActiveMural{
    background: #f3f3f7 !important;
    border-color: white;
    border: 1px solid;
    color: white !important;
}
</style>

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
                        <h2 class="display-3 text-white">Mural de Feedback</h2>
                        <p class="lead text-white">
                            Escolha abaixo o tipo de feedback que deseja ver
                        </p>
                    </div>
                </div>
                <div class="row row-grid">
                    <div  @click="changeMuralType('0')" :class="['nav-link', 'col-2']" style="margin-top:48px;"  >
                        <icon :class="this.mural.type!=='0'?'bg-gradient-lighter':'bg-gradient-white'" name="ni ni-like-2 text-default" size="lg" shadow round ></icon>
                    </div>
                    <div  @click="changeMuralType('1')" :class="['nav-link', 'col-2']">
                        <icon :class="this.mural.type!=='1'?'bg-gradient-lighter':'bg-gradient-white'" name="ni ni-bulb-61 text-default" size="lg" shadow round ></icon>
                    </div>
                    <div  @click="changeMuralType('2')" :class="['nav-link', 'col-2']">
                        <icon :class="this.mural.type!=='2'?'bg-gradient-lighter':'bg-gradient-white'" name="fa fa-thumbs-down text-default" size="lg" shadow round ></icon>
                    </div>
                    <div  @click="changeMuralType('3')" :class="['nav-link', 'col-2']" >
                        <icon :class="this.mural.type!=='3'?'bg-gradient-lighter':'bg-gradient-white'" name="fa fa-comments text-default" size="lg" shadow round ></icon>
                    </div>
                    <div class="col-4" style="padding-right:0 !important; margin-top:auto;">
                        <div class="form-group input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div> 
                            <input v-if="this.mural.type=='0'" aria-describedby="addon-right addon-left" placeholder="Pesquisar" class="form-control" v-model="laudsTable.search" v-on:keyup="setSearch(1)">
                            <input v-if="this.mural.type=='1'" aria-describedby="addon-right addon-left" placeholder="Pesquisar" class="form-control" v-model="sugestionsTable.search" v-on:keyup="setSearch(2)">
                            <input v-if="this.mural.type=='2'" aria-describedby="addon-right addon-left" placeholder="Pesquisar" class="form-control" v-model="remonstrancesTable.search" v-on:keyup="setSearch(3)">
                            <input v-if="this.mural.type=='3'" aria-describedby="addon-right addon-left" placeholder="Pesquisar" class="form-control" v-model="questionsTable.search" >
                             
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="w-100" style="margin-top:1rem;">
                            <div v-bind:class="['collapse', this.mural.type=='0'?'show':'']">
                                <div class="card card-body" style="padding:0;">
                                    <div class="list-group" v-if="laudsTable.paginate.data.length>0">
                                        <div class="list-group-item list-group-item-action flex-column align-items-start " v-for="(feedback,index) in laudsTable.paginate.data" v-bind:key="index">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{feedback.text}}</h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img v-lazy="'assets/img/caps/'+feedback.chapter.emblem" class="rounded-circle" style="width:50px;height:50px;margin: 0;z-index:3; opacity:0.8;" v-bind:title="feedback.chapter.name">
                                                            </div>
                                                            <div class="col-8">
                                                                <small style="z-index:1000;">{{new Date(feedback.created_at).toLocaleDateString('pt-BR')}}</small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <noData v-else></noData>
                                    <div style="margin-top:1rem;">
                                        <nav aria-label="Page navigation" v-if="laudsTable.paginate.total > laudsTable.paginate.per_page">
                                            <ul class="pagination justify-content-center">
                                                <li v-bind:class="['page-item',laudsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(1,1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Início</span>
                                                    </button>
                                                </li>
                                                <li v-bind:class="['page-item',laudsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(1,laudsTable.paginate.current_page-1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Voltar</span>
                                                    </button>
                                                </li>
                                                <div v-if="laudsTable.paginate.last_page<=3" style="display: inline-flex;">
                                                    <li v-bind:class="['page-item',page==laudsTable.paginate.current_page?'active':'']" v-for="(page,index) in laudsTable.paginate.last_page" v-bind:key="index"><button v-on:click="setPageDatatable(1,page)" class="page-link">{{page}}</button></li>
                                                </div>
                                                <div style="display: inline-flex;" v-else>
                                                    <li class="page-item"><button v-on:click="setPageDatatable(1,laudsTable.paginate.current_page-1)" class="page-link">{{laudsTable.paginate.current_page-1}}</button></li>
                                                    <li class="page-item active"><button v-on:click="setPageDatatable(1,laudsTable.paginate.current_page)" class="page-link">{{laudsTable.paginate.current_page}}</button></li>
                                                    <li class="page-item" v-if="laudsTable.paginate.current_page+1<=laudsTable.paginate.last_page"><button v-on:click="setPageDatatable(1,laudsTable.paginate.current_page+1)" class="page-link">{{laudsTable.paginate.current_page+1}}</button></li>
                                                </div>
                                               
                                                
                                                <li class="page-item"  v-bind:class="['page-item',laudsTable.paginate.current_page==laudsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(1,laudsTable.paginate.current_page+1)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Próximo</span>
                                                    </button>
                                                </li>
                                                <li class="page-item"  v-bind:class="['page-item',laudsTable.paginate.current_page==laudsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(1,laudsTable.paginate.last_page)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Fim</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="['collapse' ,this.mural.type=='1'?'show':'']">
                                <div class="card card-body" style="padding:0;">
                                    <div class="list-group" v-if="sugestionsTable.paginate.data.length>0">
                                        <div class="list-group-item list-group-item-action flex-column align-items-start " v-for="(feedback,index) in sugestionsTable.paginate.data" v-bind:key="index">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{feedback.text}}</h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img v-lazy="'assets/img/caps/'+feedback.chapter.emblem" class="rounded-circle" style="width:50px;height:50px;margin: 0;z-index:3; opacity:0.8;" v-bind:title="feedback.chapter.name">
                                                            </div>
                                                            <div class="col-8">
                                                                <small style="z-index:1000;">{{new Date(feedback.created_at).toLocaleDateString('pt-BR')}}</small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <noData v-else></noData>
                                    <div style="margin-top:1rem;">
                                        <nav aria-label="Page navigation" v-if="sugestionsTable.paginate.total > sugestionsTable.paginate.per_page">
                                            <ul class="pagination justify-content-center">
                                                <li v-bind:class="['page-item',sugestionsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(2,1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Início</span>
                                                    </button>
                                                </li>
                                                <li v-bind:class="['page-item',sugestionsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(2,sugestionsTable.paginate.current_page-1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Voltar</span>
                                                    </button>
                                                </li>
                                                <div v-if="sugestionsTable.paginate.last_page<=3" style="display: inline-flex;">
                                                    <li v-bind:class="['page-item',page==sugestionsTable.paginate.current_page?'active':'']" v-for="(page,index) in sugestionsTable.paginate.last_page" v-bind:key="index"><button v-on:click="setPageDatatable(2,page)" class="page-link">{{page}}</button></li>
                                                </div>
                                                <div style="display: inline-flex;" v-else>
                                                    <li class="page-item"><button v-on:click="setPageDatatable(2,sugestionsTable.paginate.current_page-1)" class="page-link">{{sugestionsTable.paginate.current_page-1}}</button></li>
                                                    <li class="page-item active"><button v-on:click="setPageDatatable(2,sugestionsTable.paginate.current_page)" class="page-link">{{sugestionsTable.paginate.current_page}}</button></li>
                                                    <li class="page-item" v-if="sugestionsTable.paginate.current_page+1<=sugestionsTable.paginate.last_page"><button v-on:click="setPageDatatable(2,sugestionsTable.paginate.current_page+1)" class="page-link">{{sugestionsTable.paginate.current_page+1}}</button></li>
                                                </div>
                                               
                                                
                                                <li class="page-item"  v-bind:class="['page-item',sugestionsTable.paginate.current_page==sugestionsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(2,sugestionsTable.paginate.current_page+1)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Próximo</span>
                                                    </button>
                                                </li>
                                                <li class="page-item"  v-bind:class="['page-item',sugestionsTable.paginate.current_page==sugestionsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(2,sugestionsTable.paginate.last_page)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Fim</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="['collapse', this.mural.type=='2'?'show':'']">
                                <div class="card card-body" style="padding:0;">
                                    <div class="list-group" v-if="remonstrancesTable.paginate.data.length>0">
                                        <div class="list-group-item list-group-item-action flex-column align-items-start " v-for="(feedback,index) in remonstrancesTable.paginate.data" v-bind:key="index">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{feedback.text}}</h5>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img v-lazy="'assets/img/caps/'+feedback.chapter.emblem" class="rounded-circle" style="width:50px;height:50px;margin: 0;z-index:3; opacity:0.8;" v-bind:title="feedback.chapter.name">
                                                            </div>
                                                            <div class="col-8">
                                                                <small style="z-index:1000;">{{new Date(feedback.created_at).toLocaleDateString('pt-BR')}}</small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <noData v-else></noData>
                                    <div style="margin-top:1rem;">
                                        <nav aria-label="Page navigation" v-if="remonstrancesTable.paginate.total > remonstrancesTable.paginate.per_page">
                                            <ul class="pagination justify-content-center">
                                                <li v-bind:class="['page-item',remonstrancesTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(3,1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Início</span>
                                                    </button>
                                                </li>
                                                <li v-bind:class="['page-item',remonstrancesTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(3,remonstrancesTable.paginate.current_page-1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Voltar</span>
                                                    </button>
                                                </li>
                                                <div v-if="remonstrancesTable.paginate.last_page<=3" style="display: inline-flex;">
                                                    <li v-bind:class="['page-item',page==remonstrancesTable.paginate.current_page?'active':'']" v-for="(page,index) in remonstrancesTable.paginate.last_page" v-bind:key="index"><button v-on:click="setPageDatatable(3,page)" class="page-link">{{page}}</button></li>
                                                </div>
                                                <div style="display: inline-flex;" v-else>
                                                    <li class="page-item"><button v-on:click="setPageDatatable(3,remonstrancesTable.paginate.current_page-1)" class="page-link">{{remonstrancesTable.paginate.current_page-1}}</button></li>
                                                    <li class="page-item active"><button v-on:click="setPageDatatable(3,remonstrancesTable.paginate.current_page)" class="page-link">{{remonstrancesTable.paginate.current_page}}</button></li>
                                                    <li class="page-item" v-if="remonstrancesTable.paginate.current_page+1<=remonstrancesTable.paginate.last_page"><button v-on:click="setPageDatatable(3,remonstrancesTable.paginate.current_page+1)" class="page-link">{{remonstrancesTable.paginate.current_page+1}}</button></li>
                                                </div>
                                               
                                                
                                                <li class="page-item"  v-bind:class="['page-item',remonstrancesTable.paginate.current_page==remonstrancesTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(3,remonstrancesTable.paginate.current_page+1)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Próximo</span>
                                                    </button>
                                                </li>
                                                <li class="page-item"  v-bind:class="['page-item',remonstrancesTable.paginate.current_page==remonstrancesTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(3,remonstrancesTable.paginate.last_page)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Fim</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="['collapse' ,this.mural.type=='3'?'show':'']">
                                <div class="card card-body" style="padding:0;">
                                    <div class="list-group" v-if="questionsTable.paginate.data.length>0">
                                        <div class="list-group-item list-group-item-action flex-column align-items-start " v-for="(feedback,index) in questionsTable.paginate.data" v-bind:key="index">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">O Gabinete pretende vir para a instalação da próxima gestão de oficiais?</h5>
                                                <small>22/09/2018</small>
                                            </div>
                                            <p class="mb-1">Estamos trabalhando para que possamos ter todo cronograma seguido corretamente e isso está dentro do que planejamos.</p>
                                            <small>Respondido 23/09/2018</small>
                                        </div>
                                    </div>
                                    <noData v-else></noData>
                                    <div style="margin-top:1rem;">
                                        <nav aria-label="Page navigation" v-if="questionsTable.paginate.total > questionsTable.paginate.per_page">
                                            <ul class="pagination justify-content-center">
                                                <li v-bind:class="['page-item',questionsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(4,1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Início</span>
                                                    </button>
                                                </li>
                                                <li v-bind:class="['page-item',questionsTable.paginate.current_page==1?'disabled':'']">
                                                    <button class="page-link"  tabindex="-1" v-on:click="setPageDatatable(4,questionsTable.paginate.current_page-1)">
                                                        <i class="fa fa-angle-left"></i>
                                                        <span class="sr-only">Voltar</span>
                                                    </button>
                                                </li>
                                                <div v-if="questionsTable.paginate.last_page<=3" style="display: inline-flex;">
                                                    <li v-bind:class="['page-item',page==questionsTable.paginate.current_page?'active':'']" v-for="(page,index) in questionsTable.paginate.last_page" v-bind:key="index"><button v-on:click="setPageDatatable(4,page)" class="page-link">{{page}}</button></li>
                                                </div>
                                                <div style="display: inline-flex;" v-else>
                                                    <li class="page-item"><button v-on:click="setPageDatatable(4,questionsTable.paginate.current_page-1)" class="page-link">{{questionsTable.paginate.current_page-1}}</button></li>
                                                    <li class="page-item active"><button v-on:click="setPageDatatable(4,questionsTable.paginate.current_page)" class="page-link">{{questionsTable.paginate.current_page}}</button></li>
                                                    <li class="page-item" v-if="questionsTable.paginate.current_page+1<=questionsTable.paginate.last_page"><button v-on:click="setPageDatatable(4,questionsTable.paginate.current_page+1)" class="page-link">{{questionsTable.paginate.current_page+1}}</button></li>
                                                </div>
                                               
                                                
                                                <li class="page-item"  v-bind:class="['page-item',questionsTable.paginate.current_page==questionsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(4,questionsTable.paginate.current_page+1)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Próximo</span>
                                                    </button>
                                                </li>
                                                <li class="page-item"  v-bind:class="['page-item',questionsTable.paginate.current_page==questionsTable.paginate.last_page?'disabled':'']" >
                                                    <button class="page-link" v-on:click="setPageDatatable(1,questionsTable.paginate.last_page)" >
                                                        <i class="fa fa-angle-right"></i>
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="sr-only">Fim</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-lg pt-lg-0 section-contact-us" id="give-feedback">
            <div class="container">
                <div class="row justify-content-center mt--200">
                    <div class="col-lg-9">
                        <card gradient="secondary" shadow body-classes="p-lg-7">
                            <h4 class="mb-3">Qual tipo de Feedback quer nos dar?</h4>
                            <div v-bind:class="['alert' ,success?'alert-success':'alert-danger' ,'alert-dismissible', 'fade', 'show']" role="alert" v-if="success!==''">
                                <span class="alert-inner--icon"><i v-bind:class="['fa', success?'fa-check-circle':'fa-exclamation-circle']"></i></span>
                                <span class="alert-inner--text">{{errors.message}}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="success=''">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="btn-wrapper mb-3" >
                                <base-button tag="a"
                                            :class="['mb-3', 'mb-sm-0',this.data.feedbackType==='0'&&this.data.feedbackType!==''?'active':'']"
                                            type="white"
                                            icon="fa fa-thumbs-up"
                                            @click="changeType('0')">
                                    Elogio
                                </base-button>
                                <base-button tag="a"
                                            :class="['mb-3', 'mb-sm-0',this.data.feedbackType==='1'&&this.data.feedbackType!==''?'active':'']"
                                            type="white"
                                            icon="ni ni-bulb-61"
                                            @click="changeType('1')">
                                    Sugestão
                                </base-button>
                                <base-button tag="a"
                                            :class="['mb-3', 'mb-sm-0',this.data.feedbackType==='2'&&this.data.feedbackType!==''?'active':'']"
                                            type="white"
                                            icon="fa fa-thumbs-down"
                                            @click="changeType('2')">
                                    Crítica
                                </base-button>
                                <!--
                                <base-button tag="a"
                                            :class="['mb-3', 'mb-sm-0',this.data.feedbackType==3&&this.data.feedbackType!=''?'active':'']"
                                            type="white"
                                            icon="fa fa-comments"
                                            @click="changeType(3)">
                                    Pergunta
                                </base-button>-->
                            </div>
                            <div class="form-group">
                                <select class="form-control" v-model="data.chapters">
                                    <option value="" disabled>Escolha seu capítulo</option>
                                    <option v-bind:value="chapter.id" v-for="(chapter,index) in chapters" v-bind:key="index">{{chapter.name}}</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <textarea rows="3" v-model="data.text" v-bind:placeholder="'Digite '+ (this.data.feedbackType=='0'?' o seu ':' a sua ')+(this.feedbackTypes[this.data.feedbackType]!==undefined?this.feedbackTypes[this.data.feedbackType]:'feedback')" class="form-control form-control-alternative"></textarea>
                            </div>
                            <base-button type="default" round block size="lg" v-on:click="add()">
                                Enviar {{this.feedbackTypes[this.data.feedbackType]?this.feedbackTypes[this.data.feedbackType]:'feedback'}}
                            </base-button>
                        </card>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import axios from "axios";
import noData from "./NoDataListItem.vue";
export default {
/* eslint-disable */
    components:{
        noData
    },
    mounted(){
    },
    created(){
        this.getCharpters();
        this.getDatatable(this.laudsTable);
        this.getDatatable(this.sugestionsTable);
        this.getDatatable(this.remonstrancesTable);
        this.getDatatable(this.questionsTable);
    },
    data() {
        return{
            data:{
                feedbackType:'',
                text:'',
                chapters:''
            },
            success:'',
            errors:{
                feedbackType:'',
                chapter:'',
                text:''
            },
            feedbackTypes:[
                'Elogio','Sugestão','Crítica','Pergunta'
            ],
            chapters:{
                
            },
            mural:{
                type:'0'
            },
            laudsTable:{
                search:'',
                feedbackType:'1',
                paginate:{
                    per_page:'5',
                    current_page:'1',
                    last_page:''

                }
            },
            sugestionsTable:{
                search:'',
                feedbackType:'2',
                paginate:{
                    per_page:'5',
                    current_page:'1',
                }
            },
            remonstrancesTable:{
                search:'',
                feedbackType:'3',
                paginate:{
                    per_page:'5',
                    current_page:'1',

                }

            },
            questionsTable:{
                search:'',
                feedbackType:'4',
                paginate:{
                    per_page:'5',
                    current_page:'1',
                    
                    
                    

                }
            }

        }
    },
    methods:{
        changeType(index){
            this.data.feedbackType = index;
        },
        changeMuralType(index){
            this.mural.type = index;
        },
        add(){
            var data = new FormData();
            data.append('feedbackType', this.data.feedbackType+1);
            data.append('text', this.data.text);
            data.append('chapter', this.data.chapters);
            axios.post('feedback/add',data)
                .then((res)=>{
                    this.success = res.data.success;
                    this.errors.message = res.data.message;
                    this.errors.feedbackType = res.data.errors.feedbackType!=undefined?res.data.errors.feedbackType:'';
                    this.errors.chapter = res.data.errors.chapter!=undefined?res.data.errors.chapter:'';
                    this.errors.text = res.data.errors.text!=undefined?res.data.errors.text:'';
                })
                .catch((err)=>{

                })

        },
        getCharpters(){
            axios.get("chapter")
                .then((res)=>{
                    this.chapters = res.data;
                })
                .catch((err)=>{

                })
        },
        getDatatable(table){
            axios.get('feedback/datatable',{params: table})
                .then((res)=>{
                    switch(table.feedbackType){
                        case '1':
                            this.laudsTable.paginate = res.data;
                            break;
                        case '2':
                            this.sugestionsTable.paginate = res.data;
                            break;
                        case '3':
                            this.remonstrancesTable.paginate = res.data;
                            break;
                        case '4':
                            this.questionsTable.paginate = res.data;
                            break;                                
                        default:
                            break; 

                    }
                })
                .catch((err)=>{

                })
        },
        setPageDatatable(feedbackType,current_page){
            switch(feedbackType){
                case 1:
                    this.laudsTable.paginate.current_page = current_page;
                    this.getDatatable(this.laudsTable);
                    break;
                case 2:
                    this.sugestionsTable.paginate.current_page = current_page;
                    this.getDatatable(this.sugestionsTable);
                    break;
                case 3:
                    this.remonstrancesTable.paginate.current_page = current_page;
                    this.getDatatable(this.remonstrancesTable);
                    break;
                case 4:
                    this.questionsTable.paginate.current_page = current_page;
                    this.getDatatable(this.questionsTable);
                    break;                                
                default:
                    break; 
            }
        },
        setSearch(feedbackType){
            switch(feedbackType){
                case 1:
                    this.laudsTable.paginate.current_page = 1;
                    this.getDatatable(this.laudsTable);
                    break;
                case 2:
                    this.sugestionsTable.paginate.current_page = 1;
                    this.getDatatable(this.sugestionsTable);
                    break;
                case 3:
                    this.remonstrancesTable.paginate.current_page = 1;
                    this.getDatatable(this.remonstrancesTable);
                    break;
                case 4:
                    this.questionsTable.paginate.current_page = 1;
                    this.getDatatable(this.questionsTable);
                    break;                                
                default:
                    break; 
            }
        }
    }
};
</script>
