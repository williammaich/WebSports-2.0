<template>
  <div>
  <login
    api-url="http://localhost:8000"
    clientId="2"
    secret="n5JYhuh7qmmkmU2ofxIY618zuJ35qzQj6ezshpUm"
    @success="handleLogin"
    @error="handleErrors">
    </login>
    <div class="alert alert-danger" v-if="error">
      <button type="button" aria-hidden="true" class="close" @click="error = false">×</button>
      <span>
        <b> Erro - </b> Credenciais incorretas </span>
    </div>
  </div>
</template>

<script>
import Login from '../Plugins/Login'
import axios from 'axios'

var instance = axios.create()

export default {
  data() {
    return {
        error : false
    }
  },
  components: { Login },
  methods: {
    handleLogin (payload) {
      // this.$store.dispatch('load-user', payload.authUser)
      this.$http.headers.common['Authorization'] = payload.header.Authorization
      console.log(this.$http.headers.common['Authorization'])
      this.$router.push('admin/dashboard')
      this.$Progress.finish()
    },
    handleErrors (errors) {

      // console.error('Authorization error' + errors)
      this.$Progress.fail()
      this.error = true;
    }
  }
}
</script>

<style lang="scss">
.alert {
  position: absolute;
  top: 15px;
  width: 100%
}

</style>
