import * as types from './mutation-types'

export default {
  [ types.INCREMENT ] (state) {
    state.count++
  },
  [ types.DECREMENT ] (state) {
    state.count--
  },
  [ types.COUNT ] (state, count) {
    state.count = count
  },
  [ types.SET_TASKS ] (state, tasks) {
    state.tasks = tasks
  }
}

// export const increment = (state) => {
//   state.count++
// }
//
// export const decrement = (state) => {
//   state.count--
// }
//
// export const count = (state, count) => {
//   state.count = count
// }
//
// export const tasks = (state, tasks) => {
//   state.tasks = tasks
// }
