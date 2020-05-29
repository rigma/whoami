<template>
  <nav>
    <ul>
      <li>
        <router-link to="/">Accueil</router-link>
      </li>
    </ul>
    <ul v-if="!loggedIn">
      <li>
        <router-link to="/connexion">Se connecter</router-link>
      </li>
      <li>
        <router-link to="/s-inscrire">S'inscrire</router-link>
      </li>
    </ul>
    <div v-else>
      <a @click.prevent="onLogOut" href="javascript://">Se déconnecter</a>
    </div>
  </nav>
  <main>
    <router-view />
  </main>
</template>

<script>
import { defineComponent, computed } from 'vue'
import globalState from './state'

export default defineComponent({
  name: 'App',
  setup () {
    const loggedIn = computed(() => globalState.token !== null)
    
    const onLogOut = () => {
      globalState.token = null
    }

    return { loggedIn, onLogOut }
  }
})
</script>
