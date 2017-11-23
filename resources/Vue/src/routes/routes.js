import DashboardLayout from '../components/Dashboard/Layout/DashboardLayout.vue'
// GeneralViews
import NotFound from '../components/GeneralViews/NotFoundPage.vue'

// Auth pages
import Login from '../components/Authentication/Views/Login.vue'
// Admin pages
import Overview from 'src/components/Dashboard/Views/Overview.vue'
import Clientes from 'src/components/Dashboard/Views/Clientes.vue'
import Notifications from 'src/components/Dashboard/Views/Notifications.vue'
import Icons from 'src/components/Dashboard/Views/Icons.vue'
import Typography from 'src/components/Dashboard/Views/Typography.vue'
import Reservas from 'src/components/Dashboard/Views/Reservas.vue'
import Usuarios from 'src/components/Dashboard/Views/Usuarios.vue'
import Calendar from 'src/components/Dashboard/Views/Calendar.vue'

import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

const routes = [
  {path: '/', redirect: '/login'},
  {
    path: '/login',
    component: Login,
  },
  {
    path: '/admin',
    component: DashboardLayout,
    redirect: '/admin/dashboard',
    children: [
      {
        path: 'calendar',
        name: 'Calendário',
        component: Calendar
      },
      {
        path: 'dashboard',
        name: 'dashboard',
        component: Overview
      },
      {
        path: 'clientes',
        name: 'clientes',
        component: Clientes
      },
      {
        path: 'notifications',
        name: 'notifications',
        component: Notifications
      },
      {
        path: 'icons',
        name: 'icons',
        component: Icons
      },
      {
        path: 'sair',
        name: 'sair',
        redirect: '/login'
      },
      {
        path: 'reservas',
        name: 'reservas',
        component: Reservas
      },
      {
        path: 'usuarios',
        name: 'usuários',
        component: Usuarios
      }

    ],


  },

  { path: '*', component: NotFound }
]


export default routes
