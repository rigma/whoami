<template>
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
</template>

<script>
import { defineComponent, reactive, toRefs } from 'vue'
import { useRouter } from 'vue-router'
import { API_BASE_URL } from '../constants'

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
          body: JSON.stringify(user)
        })
      } catch (err) {
        console.error(err)
        return
      }

      if (res.status !== 201) {
        console.error('Unable to signup!')
        return
      }

      router.push('/')
    }

    return {
      ...toRefs(user),
      onSubmit
    }
  }
})
</script>
