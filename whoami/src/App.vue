<template>
  <nav>
    <ul v-if="loggedIn">
      <li>
        <a href="javascript://">Lien super secret, ne pas cliquer !</a>
      </li>
      <li>
        <a @click.prevent="onLogOut" href="javascript://">Se déconnecter</a>
      </li>
    </ul>
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
