<template>
    <section class="section section-shaped section-lg my-0">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-md">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <card type="secondary" shadow
                          header-classes="bg-white pb-5"
                          body-classes="px-lg-5 py-lg-5"
                          class="border-0">
                        <template>
                            <form role="form">
                                <div class="form-group mb-3 input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ni ni-hat-3"></i>
                                        </span>
                                    </div>
                                 <input aria-describedby="addon-right addon-left" placeholder="Nome completo" class="form-control">
                                </div>
                                <div class="form-group mb-3 input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ni ni-email-83"></i>
                                        </span>
                                    </div>
                                    <input aria-describedby="addon-right addon-left" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ni ni-lock-circle-open"></i>
                                        </span>
                                    </div>
                                    <input aria-describedby="addon-right addon-left" type="password" placeholder="Senha" class="form-control">
                                </div>
                                <div class="form-group input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ni ni-lock-circle-open"></i>
                                        </span>
                                    </div>
                                    <input aria-describedby="addon-right addon-left" type="password" placeholder="Confirmar senha" class="form-control">
                                </div>
                                <div class="text-muted font-italic">
                                    <small>Segurança da senha:
                                        <span class="text-success font-weight-700">Forte</span>
                                    </small>
                                </div>
                                <div class="text-center">
                                    <base-button type="default" class="my-4">Registrar usuário</base-button>
                                </div>
                            </form>
                        </template>
                    </card>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {};
</script>
<style>
</style>
