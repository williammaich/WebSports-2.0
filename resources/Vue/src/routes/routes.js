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
import Maps from 'src/components/Dashboard/Views/Maps.vue'
import Typography from 'src/components/Dashboard/Views/Typography.vue'
import Reservas from 'src/components/Dashboard/Views/Reservas.vue'

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login,
    redirect: '/login'
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/admin',
    component: DashboardLayout,
    redirect: '/admin/dashboard',
    children: [
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
        path: 'maps',
        name: 'maps',
        component: Maps
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
      }

    ],


  },

  { path: '*', component: NotFound }
]


export default routes