<style lang="scss">
    .row {
        height: 100vh;
    }

    .bg-img {
        background: linear-gradient(to right, rgba(54, 14, 120, 0.5), rgba(98, 81, 113, 0.6)),
        linear-gradient(to right, rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),
        url("http://www.wallpapersin4k.org/wp-content/uploads/2017/04/High-School-Football-Wallpaper-2.jpg") center;
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
        &:focus ~ label {
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
                -webkit-transition: all 0.3s ease-in-out border-top-style 0.0s ;
                -moz-transition: all 0.3s ease-in-out border-top-style 0.0s ;
                transition: all 0.3s  ease-in-out, border-top-style 0.0s ;
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

    a {
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


<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-6 d-none d-md-block bg-img">
                <div class="row">
                    <div class="title align-self-end">
                        <h2>web<strong>sports.</strong></h2>
                        <br>
                        <p>O seu sistema para gerenciar suas quadras</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-xl-4 d-flex justify-content-center align-items-center">
                <div class="login-box">
                    <h4>Login</h4>
                    <p>Entre em sua conta</p>

                    <form action="">
                        <div class="form-group">
                            <input type="email" name="email" id="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password">
                            <label for="password">Senha</label>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox"> Lembrar-me</label>
                            <a class="text-muted">Esqueceu sua senha?</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-login btn-block btn-primary" type="submit">LOGIN</button>
                        </div>
                    </form>
                    <div class="divider">
                        <span class="hr">Ou logue-se com</span>
                    </div>
                    <div class="text-center">
                        <a href="" class="btn btn-square btn-facebook">FB</a>
                        <a href="" class="btn btn-square btn-google">GG</a>
                        <a href="" class="btn btn-square btn-twitter">TW</a>
                    </div>
                    <hr>
                    <p>Não tens conta?
                        <router-link to="/register">Registre-se</router-link>
                    </p>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                hello: ''
            }
        }
    }
</script>