import Sidebar from './SideBar.vue'

const SidebarStore = {
  showSidebar: false,
  sidebarLinks: [
    {
      name: 'Dashboard',
      icon: 'ti-panel',
      path: '/admin/overview'
    },
    {
      name: 'Clientes',
      icon: 'ti-user',
      path: '/admin/stats'
    },
    {
      name: 'Reservas',
      icon: 'ti-timer',
      path: '/admin/table-list'
    },
    {
      name: 'Relatórios',
      icon: 'ti-stats-up',
      path: '/admin/typography'
    },
    {
      name: 'Sair',
      icon: 'ti-power-off',
      path: '/admin/icons'
    }
  ],
  displaySidebar (value) {
    this.showSidebar = value
  }
}

const SidebarPlugin = {

  install (Vue) {
    Vue.mixin({
      data () {
        return {
          sidebarStore: SidebarStore
        }
      }
    })

    Object.defineProperty(Vue.prototype, '$sidebar', {
      get () {
        return this.$root.sidebarStore
      }
    })
    Vue.component('side-bar', Sidebar)
  }
}

export default SidebarPlugin
