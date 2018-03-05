import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import MainLayout from '@/components/MainLayout'
import Login from '@/components/Login'
import Landing from '@/components/Landing'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/',
      name: 'Landing',
      component: Landing
    },

    {
      path: '/content',
      name: 'MainLayout',
      component: MainLayout,
      children: [
        {
          path: '/',
          name: 'HelloWorld',
          component: HelloWorld
        }
      ]
    }
  ]
})
