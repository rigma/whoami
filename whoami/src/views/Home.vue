<template>
  <article v-if="userInfo !== null">
    <h1>Petit rappel de votre identité 😉</h1>
    <p>Votre adresse électronique : {{ userInfo.email }}</p>
    <p>Votre numéro de téléphone : {{ userInfo.phone_number }}</p>
  </article>
  <article v-else>
    <h1>N'oubliez plus votre courriel et votre numéro de téléphone ! 🤯</h1>
    <div>
      <router-link to="/connexion">Se connecter</router-link>
      ou
      <router-link to="/s-inscrire">S'inscrire</router-link>
    </div>
  </article>
</template>

<script>
import { defineComponent, ref, watch } from 'vue'
import { API_BASE_URL } from '../constants'
import globalState from '../state'

const userInfo = ref(null)
const sessionExpired = ref(false)

export default defineComponent({
  name: 'Home',
  setup () {
    watch(() => globalState.token, (token, prev) => {
      if (token === null) {
        userInfo.value = null
      }
    })

    return { sessionExpired, userInfo }
  },
  async beforeRouteEnter (to, from, next) {
    if (globalState.token === null) {
      sessionExpired.value = globalState.sessionExpired
      return next()
    }

    let res
    try {
      res = await fetch(`${API_BASE_URL}/api/user/me`, {
        headers: {
          'Authorization': `Bearer ${globalState.token}`
        }
      })
    } catch (err) {
      console.error(err)
      return next()
    }

    if (res.status === 401) {
      globalState.token = null
      globalState.sessionExpired = true

      return next()
    } else if (res.status !== 200) {
      return next()
    }

    userInfo.value = await res.json();
    next()
  }
})
</script>
