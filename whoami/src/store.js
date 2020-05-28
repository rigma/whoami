import { createStore } from 'vuex'

const state = {
  auth: {
    token: null
  }
}

export default createStore({
  state,
})
