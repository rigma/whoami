import { createRouter, createWebHistory } from 'vue-router'
import Home from './views/Home.vue'
import SignIn from './views/SignIn.vue'
import SignUp from './views/SignUp.vue'

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/connexion',
      component: SignIn
    },
    {
      path: '/s-inscrire',
      component: SignUp
    }
  ]
})
