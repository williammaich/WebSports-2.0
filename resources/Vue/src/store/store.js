import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(VueResource)
Vue.use(Vuex)


const state = {
  reserva: {},
  users: [],
  reservas: [],
  clientes: []
}

const mutations = {
  'set-clientes' (state, clientes) {
    state.clientes = clientes
  },
  'set-user' (state, users) {
    state.users = users;
  },
  'set-reservas' (state, reservas) {
    state.reservas = reservas;
  },
  'set-reserva' (state, reserva) {
    state.reserva = reserva;
  }
}

const actions = {
  'load-clientes' (context) {
    Vue.http.get('http://localhost:8000/api/clientes')
      .then(response => {
        let clientes = response.data.map(element => {
          return {
            'id': element.id,
            'nome do cliente': element.nome,
            'email': element.email,
            'endereço': `${element.endereco.rua}, ${element.endereco.numero}` && `${element.endereco.rua}, ${element.endereco.numero}, ${(element.endereco.complemento || '')}`,
            'cpf': element.cpf,
            'saldo': element.saldo.toLocaleString('pt-BR', {
              style: 'currency',
              currency: 'BRL'
            })
          }
        })
        context.commit('set-clientes', clientes)
      })
  },
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
  'load-reserva' (context, id) {
    Vue.http.get(`http://localhost:8000/api/reservas/${id}`)
      .then(response => {
        let reserva = response.data
        console.log('reserva load')
        context.commit('set-reserva', reserva)
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
  },
  'update-clientes' (context, cliente) {
    let column = cliente.column
    let data = {}
    console.log(data)

    if (cliente.column == "Endereço") {
      data = {
        "endereco": {
          rua: cliente.rua,
          numero: cliente.numero,
          complemento: cliente.complemento
        }
      }
    } else {
      data[column.toLowerCase()] = cliente.value
    }
    console.log(data)
    Vue.http.put(`http://localhost:8000/api/clientes/${cliente.id}`, data)
      .then(response => {
        console.log(response.status)
      })

  },
  'create-users' (context, users) {
    Vue.http.post('http://localhost:8000/api/users', users)
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
