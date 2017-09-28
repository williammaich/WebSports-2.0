<style lang="scss">

</style>
<template lang="pug">
    .container-fluid
        .row
            .col-lg-7.col-md-6.col-xl-8.d-none.d-md-block.bg-img
                side-login
            .col-lg-5.col-md-6.col-xl-4.d-flex.justify-content-center.align-items-center
                .login-box
                    h4 Recuperar sua senha
                    p Digite seu e-mail e receba sua senha
                    form(action="/forgot" method="post")
                        div(v-for="input in inputs")
                            .form-group

                                input(type="email" :name="input.for" v-model="input.value" :id="input.for" @focus="input.isActive = true" @blur="input.isActive = false")
                                label(v-bind:for="input.for" :class="{active: input.isActive || input.value}") {{input.label}}

                        .form-group.d-flex.justify-content-between
                            label(for="rememberme")
                            input(type="hidden" name="_token" :value="csrf")
                            router-link(to="Login") Voltar
                        .form-group(slot="submit")
                            button.btn.btn-login.btn-block.btn-primary(type="submit") ENVIAR


</template>

<script>
    import SideLogin from '../components/SideLogin.vue';
    export default {
        components: {
            SideLogin
        },
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                inputs: [
                    {
                        for: 'email',
                        type: 'email',
                        label: 'E-mail',
                        value: '',
                        error: '',
                        isActive: ''
                    }
                ]
            }
        }
    }
</script>