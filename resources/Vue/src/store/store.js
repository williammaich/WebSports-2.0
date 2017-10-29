import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(VueResource)
Vue.use(Vuex)


const state = {
  user: {},
  reservas: []
}

const mutations = {
  'set-user'(state, user) {
    state.user = user;
  },
  'set-reservas'(state, reservas) {
    state.reservas = reservas;
  }
}

const actions = {
  'load-user'(context, user) {
    context.commit('set-user', user)
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
