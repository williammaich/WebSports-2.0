<style lang="scss">

</style>
<template lang="pug">
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
                slot(name="voltar")
            slot(name="submit")


</template>

<script>
    import Login from '../views/Login.vue';
    export default {
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                Login,
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