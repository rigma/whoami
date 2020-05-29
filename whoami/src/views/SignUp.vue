<template>
  <h1>Inscription</h1>
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
    <div class="group">
      <label for="phone-number">Votre numéro de téléphone :</label>
      <input type="tel"
        id="phone-number"
        placeholder="Ton numéro de téléphone pour qu'en s'en souvienne pour toi"
        aria-placeholder="Ton numéro de téléphone pour qu'en s'en souvienne pour toi"
      />
    </div>
    <button type="submit">Je m'inscris !</button>
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
