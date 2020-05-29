<template>
  <article v-if="userInfo !== null">
    <h1>Petit rappel de votre identité 😉</h1>
    <p>Votre adresse électronique : {{ userInfo.email }}</p>
    <p>Votre numéro de téléphone : {{ userInfo.phone_number }}</p>
  </article>
  <article v-else>
    <h1>N'oubliez plus votre courriel et votre numéro de téléphone ! 🤯</h1>
    <ul class="auth-box">
      <li>
        <router-link to="/connexion">Se connecter</router-link>
      </li>
      <li>
        ou
      </li>
      <li>
        <router-link to="/s-inscrire">S'inscrire</router-link>
      </li>
    </ul>
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

    // Trying to fetch the userinfo
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

    // If they are available, we'll display them on the interface
    userInfo.value = await res.json();
    next()
  }
})
</script>

<style scoped>
article {
  background: #fafafa;
  border: 1px solid var(--border-color);
  box-shadow: 0px 0px 5px 1px var(--shadow-color);
  border-radius: 7px;
  padding: 12px;
}

article h1 {
  text-align: center;
  margin-bottom: 24px;
}

article ul.auth-box {
  display: flex;
  list-style: none;
  flex-direction: row;
  justify-content: center;
  padding: 0;
}

article ul.auth-box li {
  margin: 0px 10px;
}

article ul.auth-box a {
  color: var(--text-color);
  text-decoration: underline dotted;
}
</style>
