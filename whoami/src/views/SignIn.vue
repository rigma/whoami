<template>
  <article>
    <h1>Connexion</h1>
    <form @submit.prevent="onSubmit">
      <div class="group">
        <label for="email">Adresse électronique :</label>
        <input v-model="email"
          type="email"
          id="email"
          placeholder="mail@boite.dev"
          aria-placeholder="mail@boite.dev"
          required
        />
      </div>
      <div class="group">
        <label for="password">Votre mot de passe :</label>
        <input v-model="password"
          type="password"
          id="password"
          placeholder="Il doit faire au moins 6 caractères"
          aria-placeholder="Il doit faire au moins 6 caractères"
          required
        />
      </div>
      <button type="submit">Je me connecte !</button>
    </form>
    <p>
      <router-link to="/s-inscrire">Vous n'êtes pas encore inscrit ?</router-link>
    </p>
  </article>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'
import { API_BASE_URL } from '../constants'
import globalState from '../state'

export default defineComponent({
  name: 'SignIn',
  setup () {
    const email = ref(null)
    const password = ref(null)
    const router = useRouter()

    const onSubmit = async () => {
      if (globalState.token !== null) {
        console.error('Already logged in!')
        return
      }

      const res = await fetch(`${API_BASE_URL}/api/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          email: email.value,
          password: password.value
        })
      })

      if (res.status >= 400) {
        console.error('Wrong credentials!')
        return
      }

      const token = await res.text()
      globalState.token = token
      globalState.sessionExpired = false

      router.push('/')
    }

    return { email, password, onSubmit }
  },
  beforeRouteEnter (to, from, next) {
    if (globalState.token !== null) {
      return next('/')
    }

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

article form {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

article form .group {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin: 8px 0px;
}

article form .group input {
  width: 30vw;
}

article form button[type="submit"] {
  margin-top: 8px;
}

article p {
  margin-top: 32px;
  text-align: center;
}

article p a, article p a:visited {
  color: var(--text-color);
  text-decoration: underline dotted;
}
</style>
