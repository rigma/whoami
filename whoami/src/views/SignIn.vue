<template>
  <h1>Connexion</h1>
  <form>
    <div class="group">
      <label for="email">Adresse électronique :</label>
      <input type="email"
        id="email"
        placeholder="mail@boite.dev"
        aria-placeholder="mail@boite.dev"
        required
      />
    </div>
    <div class="group">
      <label for="password">Votre mot de passe :</label>
      <input type="password"
        id="password"
        placeholder="Il doit faire au moins 6 caractères"
        aria-placeholder="Il doit faire au moins 6 caractères"
        required
      />
    </div>
    <button type="submit">Je me connecte !</button>
  </form>
</template>

<script>
import { ref } from 'vue'

export default {
  name: 'SignIn',
  setup () {
    const email = ref(null)
    const password = ref(null)

    return { email, password }
  }
}
</script>
