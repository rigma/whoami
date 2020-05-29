<template>
  <article>
    <h1>Inscription</h1>
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
          minlength="6"
          placeholder="Il doit faire au moins 6 caractères"
          aria-placeholder="Il doit faire au moins 6 caractères"
          required
        />
      </div>
      <div class="group">
        <label for="phone-number">Votre numéro de téléphone :</label>
        <input v-model="phoneNumber"
          type="tel"
          id="phone-number"
          placeholder="Ton numéro de téléphone pour qu'en s'en souvienne pour toi"
          aria-placeholder="Ton numéro de téléphone pour qu'en s'en souvienne pour toi"
          required
        />
      </div>
      <button type="submit">Je m'inscris !</button>
    </form>
    <p>
      <router-link to="/connexion">Déjà inscrit ?</router-link>
    </p>
  </article>
</template>

<script>
import { defineComponent, reactive, toRefs } from 'vue'
import { useRouter } from 'vue-router'
import { API_BASE_URL } from '../constants'
import globalState from '../state'

export default defineComponent({
  name: 'SignUp',
  setup () {
    const user = reactive({
      email: null,
      password: null,
      phoneNumber: null,
    })
    const router = useRouter()

    const onSubmit = async () => {
      let res
      try {
        res = await fetch(`${API_BASE_URL}/api/signup`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: user.email,
            password: user.password,
            phone_number: user.phoneNumber
          })
        })
      } catch (err) {
        console.error(err)
        return
      }

      if (res.status !== 201) {
        console.error('Unable to signup!')
        return
      }

      try {
        globalState.token = await res.text()
      } catch (err) {
        console.error('Unable to signup!')
        return
      }

      globalState.sessionExpired = false
      router.push('/')
    }

    return {
      ...toRefs(user),
      onSubmit
    }
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
