import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(VueResource)
Vue.use(Vuex)


const state = {
  users: [],
  reservas: []
}

const mutations = {
  'set-user'(state, users) {
    state.users = users;
  },
  'set-reservas'(state, reservas) {
    state.reservas = reservas;
  }
}

const actions = {
  'load-users'(context) {
    Vue.http.get('http://localhost:8000/api/users')
    .then(response => {
      let users = response.data.map(element => {
        return {
          'id' : element.id,
          'nome do usuario': element.name,
          'email': element.email,
          'senha' : '*********'
        }
      })
      context.commit('set-user', users)
    })
  },
  'set-user'(context, user) {
    Vue.http.post(`http://localhost:8000/api/users/${user.id}`, {
      'name' : user.nome,
      'email' : user.email,
      'password' : user.senha
    }).then(response => {
      console.log(response.status)
    })
  },
  'load-reservas'(context) {
    Vue.http.get('http://localhost:8000/api/reservas')
      .then(response => {
        let reservas = response.data.map(element => {
          return {
            'id' : element.id,
            'nome do cliente': element.cliente.nome,
            'dia': new Date(element.dataReservada).toLocaleDateString(),
            'horario': new Date(element.dataReservada).toLocaleTimeString(),
            'reservas': '1'
          }
        })
        context.commit('set-reservas', reservas)
      })
  }
}

export default new Vuex.Store({
  state,
  mutations,
  actions
})
