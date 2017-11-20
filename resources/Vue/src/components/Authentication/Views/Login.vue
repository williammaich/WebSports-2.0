<template>
  <login
    api-url="http://localhost:8000"
    clientId="2"
    secret="KCfdWxWzrQfOQuz9tUd9hHyrf5JGVTtGuKPTvaQr"
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
      // this.$store.dispatch('load-user', payload.authUser)
      this.$http.headers.common['Authorization'] = payload.header.Authorization
      console.log(this.$http.headers.common['Authorization'])
      this.$router.push('admin/dashboard')
    },
    handleErrors (errors) {
      console.error('Authorization error' + errors)
    }
  }
}
</script>

<style lang="scss">

</style>
