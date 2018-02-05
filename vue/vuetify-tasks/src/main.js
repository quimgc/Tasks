// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex'
// import axios from 'axios'

Vue.use(Vuex)

Vue.use(Vuetify)

// Store pattern -> state/model

const store = new Vuex.Store({
  strict: true,
  state: {
    count: 0,
    tasks: []
  },

  getters: {

    count: state => {
      return state.count
    },
    countTasks: state => {
      return state.count.length
    },
    tasks: state => {
      return state.tasks.length
    }
  },

  mutations: {
    increment (state) {
      // mutate state
      state.count++
    },
    decrement (state) {
      state.count--
    },
    count (state, count) {
      state.count = count
    },
    task (tasks, count) {
      tasks.count = count
    }
  },
  actions: {
    fetchTasks (context) {
      //   axios.get('/api/v1/tasks').then(response => {
      //     let tasks = response.data
      //     context.commit('tasks', tasks)
      //   }).catch(error => {
      //     console.log(error)
      //   })
      // }
      let tasks = [
        {'name': 'Comprar pa'},
        {'name': 'Estudiar més'},
        {'name': 'bla bla bla'}
      ]
      context.commit('tasks', tasks)
    }
  }
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
