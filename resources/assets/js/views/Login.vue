<style lang="scss">
    .row {
        height: 100vh;
    }

    .bg-img {
        background: linear-gradient(to right, rgba(54, 14, 120, 0.5), rgba(98, 81, 113, 0.6)),
        linear-gradient(to right, rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),
        url("../../img/bg-login.jpg") center;
        -webkit-background-size: cover;
        background-size: cover;
        padding: 0 50px;
    }

    .login-box {
        width: 100%;
        padding: 0 80px;
        font-size: 11px;
        h4 {
            font-size: 19px;
        }
        font-weight: 300;
        letter-spacing: .5px;

    }

    .form-group {
        position: relative;
    }

    input {
        width: 100%;
        border-color: transparent;
        padding-left: 0;
        padding-right: 0;
        outline: none;
        font-size: 14px;
        margin-bottom: 15px;
        -webkit-background-size: 0 2px, 100% 1px;
        background-size: 0 2px, 100% 1px;
        background-repeat: no-repeat;
        background-position: center bottom, center calc(100% - 1px);
        background-image: linear-gradient(rgba(54, 14, 120, 0.5), rgba(54, 14, 120, 0.5)), linear-gradient(#ebebeb, #ebebeb);
        -webkit-transition: background 0.3s;
        transition: background 0.3s;
        &:focus, &:active {
            background-size: 100% 2px, 100% 1px;
        }

        & ~ label {
            position: absolute;
            top: -2px;
            left: 2px;
            font-size: 13px;
            transition: .3s;
        }
        &:focus ~ label, & ~ label.active {
            top: -14px;
            font-size: 9px;
            transition: .3s;
        }

    }

    label[for=rememberme] {
        font-size: 12px;
        text-align: left;
        input {
            display: inline-block;
            width: auto;
            margin-right: 10px;

            &:before {
                -webkit-transition: all 0.3s ease-in-out, border-top-style 0.0s;
                -moz-transition: all 0.3s ease-in-out, border-top-style 0.0s;
                transition: all 0.3s ease-in-out, border-top-style 0.0s;
                content: "";
                position: absolute;
                left: 0;
                z-index: 1;
                width: 1rem;
                height: 1rem;
                border: 2px solid #f2f2f2;

            }
            &:checked:before {
                -webkit-transform: rotate(-45deg);
                -moz-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                -o-transform: rotate(-45deg);
                transform: rotate(-45deg);
                height: .5rem;
                border-color: rgba(54, 14, 120, 0.5);
                border-top-style: none;
                border-right-style: none;
            }
            &:after {
                content: "";
                position: absolute;
                top: -0.125rem;
                left: 0;
                width: 1.1rem;
                height: 1.1rem;
                background: #fff;
                cursor: pointer;
            }
        }
    }

    form {
        padding-top: 20px;
    }

    .title {
        color: #FFFFFF;
        padding-bottom: 70px;

    }

    .text-muted {
        font-size: 12px;
    }

    a, a:not([href]):not([tabindex]) {
        cursor: pointer;
        color: rgba(54, 14, 120, 0.5);
        &:hover {
            color: rgba(54, 14, 120, 1)
        }
    }

    .btn-login {
        background: rgba(54, 14, 120, 0.5);
        border: none;
        outline: none;
        border-radius: 2px;
        cursor: pointer;
        &:hover, &:active, &:focus {
            background: rgba(54, 14, 120, .7);
            border: none;
            outline: none;
            box-shadow: none;
        }
    }
</style>


<template lang="pug">
    .container-fluid
        .row
            .col-lg-7.col-md-6.col-xl-8.d-none.d-md-block.bg-img
                .row
                    .title.align-self-end
                        h2 web<strong>sports.</strong>
                        br
                        p O seu sistema para gerenciar suas quadras

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

                            a(@click="isForgot = true") Esqueceu sua senha?

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
    import Forgot from '../components/Forgot.vue';

    export default {
        components : {
          Forgot
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