<template>
    <div class="profile-page">
        <section class="section-profile-cover section-shaped my-0">
            <div class="shape shape-style-1 shape-primary shape-skew alpha-4">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>
        <section class="section section-skew">
            <div class="container">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img v-lazy="'assets/img/caps/padre-186.jpg'" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Perguntas</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Respondidas</span>
                                    </div>

                                </div>
                            </div>
                           
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Elogios</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Sugestões</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Reclamações</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <h3>Capítulo Padre Miguelinho
                                <span class="font-weight-light"> Nº186</span>
                            </h3>
                            <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>1a Região -  Natal/RN</div>
                            <div class="h6 mt-4">
                                
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">O Gabinete pretende vir para a instalação da próxima gestão de oficiais?</h5>
                                        <small>22/09/2018</small>
                                        </div>
                                        <p class="mb-1">Estamos trabalhando para que possamos ter todo cronograma seguido corretamente e isso está dentro do que planejamos.</p>
                                        <small>Respondido 23/09/2018</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">O Gabinete pretende vir para a instalação da próxima gestão de oficiais?</h5>
                                        <small>22/09/2018</small>
                                        </div>
                                        <p class="mb-1">Estamos trabalhando para que possamos ter todo cronograma seguido corretamente e isso está dentro do que planejamos.</p>
                                        <small>Respondido 23/09/2018</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">O Gabinete pretende vir para a instalação da próxima gestão de oficiais?</h5>
                                        <small>22/09/2018</small>
                                        </div>
                                        <p class="mb-1">Estamos trabalhando para que possamos ter todo cronograma seguido corretamente e isso está dentro do que planejamos.</p>
                                        <small>Respondido 23/09/2018</small>
                                    </a>
                                </div>
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-angle-right"></i>
                                        <span class="sr-only">Próximo</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </card>
            </div>
        </section>
    </div>
</template>
<script>
export default {};
</script>
<style>
</style>
