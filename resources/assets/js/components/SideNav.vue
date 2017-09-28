<style lang="scss">
    body {
        margin: 0;
        padding: 0;
    }

    aside {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 260px;
        background-color: #3f4a59;
        white-space: nowrap;
        flex-direction: column;
        header {
            flex-direction: row;
            justify-content: space-between;
            height: 64px;
            align-items: center;
            padding: 0 12px;
            color: #FFF;
            font-size: 20px;
            letter-spacing: -1px;
            background: #926dde;
            span.logo {
                padding-left: 2px;
                font-weight: 900;
            }

        }
    }

    li {
        display: block;
        a {
            display: inline-block;
            padding: 20px 20px;
        }
    }
</style>
<template lang="pug">
    aside
        header(class="d-flex")
            .logo web<span class="logo">sports.</span>
            .toggle-nav ◘
            .logo-light WS
        nav
            ul(class="menu")
                li(class="menu-category") Preview
                li(class="menu-item")
                    a(class="menu-link")
                        span(class="icon fa fa-home")
                        span(class="title") Dashboard

                li(class="menu-item")
                    a(class="menu-link" href="#")
                        span(class="icon fa fa-tv")
                        span(class="title") Samples
                        span(class="arrow")

                    ul(class="menu-submenu")
                        li(class="menu-item")
                            a(class="menu-link")
                                span(class="dot")
                                span(class="title") Invoicer

                        li(class="menu-item")
                            a(class="menu-link")
                                span(class="dot")
                                span(class="title") Job Management

                        li(class="menu-item")
                            a(class="menu-link")
                                span(class="dot")
                                span(class="title") Support System


                li(class="menu-category") Framework
</template>

<script lang="babel" type="text/babel">
    export default {}
</script>