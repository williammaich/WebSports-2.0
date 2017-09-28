<style lang="scss">

</style>


<template lang="pug">
    .container-fluid
        .row
            .col-lg-7.col-md-6.col-xl-8.d-none.d-md-block.bg-img
                side-login
            .col-lg-5.col-md-6.col-xl-4.d-flex.justify-content-center.align-items-center(v-if="!isForgot")
                .login-box
                    h4 Login
                    p Entre em sua conta
                    form(action="/login" method="post")

                        div(v-for="input in inputs")
                            .form-group
                                input(v-if="input.type == 'email'" type="email" :name="input.for" v-model="input.value" :id="input.for" @focus="input.isActive = true" @blur="input.isActive = false" required)
                                input(v-if="input.type == 'password'" type="password" :name="input.for" v-model="input.value" :id="input.for" @focus="input.isActive = true" @blur="input.isActive = false" required)
                                label(v-bind:for="input.for" :class="{active: input.isActive || input.value}") {{input.label}}

                        .form-group.d-flex.justify-content-between
                            label(for="rememberme")
                                input(name="rememberme" id="rememberme" type="checkbox")
                                | Lembrar-me

                            router-link(to="/forgot") Esqueceu sua senha?

                        .form-group
                            input(type="hidden" name="_token" :value="csrf")
                            button.btn.btn-login.btn-block.btn-primary(type="submit") LOGIN

            .col-lg-5.col-md-6.col-xl-4.d-flex.justify-content-center.align-items-center(v-else)
                forgot
                    a(@click="isForgot = false" slot="voltar") Voltar

                    .form-group(slot="submit")
                        button.btn.btn-login.btn-block.btn-primary(type="submit") ENVIAR
</template>

<script lang="babel" type="text/babel">
    import SideLogin from '../components/SideLogin.vue';
    export default {
        components :{
          SideLogin,
        },

        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                isForgot: false,
                inputs: [
                    {
                        for: 'email',
                        type: 'email',
                        label: 'E-mail',
                        value: '',
                        error: '',
                        isActive: ''
                    },
                    {
                        for: 'password',
                        type: 'password',
                        label: 'Senha',
                        value: '',
                        error: '',
                        isActive: ''
                    }
                ]
            }
        }
    }
</script>