<template>
  <login
    api-url="http://localhost:8000"
    clientId="3"
    secret="Qi65o4qVSrnlIvuLXWeITFIxhjq5RSThrM8XH92b"
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
