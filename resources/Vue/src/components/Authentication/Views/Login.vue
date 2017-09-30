<template>
  <login
    api-url="http://localhost:8000"
    clientId="1"
    secret="KzvqoGLipYDHrZJSehxBwxDXfhsX2Adyk1THdU8x"
    @success="handleLogin"
    @failed="handleErrors">
    </login>
</template>

<script>
import Login from '../Plugins/Login'
import axios from 'axios'

var instance = axios.create()

export default {
  components: { Login },
  methods: {
    handleLogin (payload) {
      this.$store.dispatch('setUser', payload.authUser)
      instance.defaults.headers.common['Authorization'] = payload.headers.Authorization
    },
    handleErrors (errors) {
      alert('Authorization error' + errors)
    }
  }
}
</script>

<style lang="scss">

</style>
