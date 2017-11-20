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
  'set-user' (state, users) {
    state.users = users;
  },
  'set-reservas' (state, reservas) {
    state.reservas = reservas;
  }
}

const actions = {
  'load-users' (context) {
    Vue.http.get('http://localhost:8000/api/users')
      .then(response => {
        let users = response.data.map(element => {
          return {
            'id': element.id,
            'nome do usuario': element.name,
            'email': element.email,
            'senha': '*********'
          }
        })
        context.commit('set-user', users)
      })
  },
  'load-reservas' (context) {
    Vue.http.get('http://localhost:8000/api/reservas')
      .then(response => {
        let reservas = response.data.map(element => {
          return {
            'id': element.id,
            'nome do cliente': element.cliente.nome,
            'dia': new Date(element.dataReservada).toLocaleDateString() + " " + new Date(element.dataReservada).toLocaleTimeString(),
            'reservas': '1'
          }
        })
        context.commit('set-reservas', reservas)
      })
  },
  'update-user' (context, user) {
    let column = user.column
    let data = {}
    data[column] = user.value
    Vue.http.put(`http://localhost:8000/api/users/${user.id}`, data)
      .then(response => {
        console.log(response.status)
      })
  },
  'update-reserva' (context, reserva) {
    let column = reserva.column
    let data = {}
    if (reserva.column == "nome") {
      data = {
        "cliente": {
          "nome": reserva.value
        }
      }
    } else {
      data[column] = reserva.value
    }
    Vue.http.put(`http://localhost:8000/api/reservas/${reserva.id}`, data)
      .then(response => {
        console.log(response.status)
      })
  }

}

export default new Vuex.Store({
  state,
  mutations,
  actions
})
