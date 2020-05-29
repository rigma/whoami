<template>
  <nav class="links">
    <ul v-if="loggedIn">
      <li>
        <router-link to="/secret">Lien super secret, ne pas cliquer !</router-link>
      </li>
      <li>
        <a @click.prevent="onLogOut" href="javascript://">Se déconnecter</a>
      </li>
    </ul>
  </nav>
  <main>
    <router-view />
    <div v-if="showWarning" class="warnings">
      <p>{{ warning }}</p>
    </div>
  </main>
</template>

<script>
import { defineComponent, computed } from 'vue'
import { WARNINGS } from './constants'
import globalState from './state'

export default defineComponent({
  name: 'App',
  setup () {
    const loggedIn = computed(() => globalState.token !== null)
    const showWarning = computed(() => globalState.warningCount > 0)
    const warning = computed(() =>
      globalState.warningCount >= WARNINGS.length
        ? WARNINGS[WARNINGS.length - 1]
        : WARNINGS[globalState.warningCount - 1]
    )
    
    const onLogOut = () => {
      globalState.token = null
      globalState.warningCount = 0
    }

    return {
      loggedIn,
      showWarning,
      warning,
      onLogOut
    }
  }
})
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Gelasio&family=Roboto&display=swap');

:root {
  --background-color: #ddd;
  --border-color: #555;
  --shadow-color: #444;
  --text-color: #333;
}

* {
  margin: 0;
}

body {
  background: var(--background-color);
  font-size: 16px;
}

h1 {
  font-family: 'Roboto', serif;
  font-size: 1.8em;
  font-weight: bold;
  color: var(--text-color);
}

p {
  font-family: 'Gelasio', serif;
  font-size: 1em;
  color: var(--text-color);
}

main {
  font-family: 'Gelasio', serif;
  font-size: 1em;
  color: var(--text-color);
  margin: 40px 128px;
}

.links {
  position: fixed;
  bottom: 0;
  right: 0;
  padding: 4px 4px;
}

.links ul {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  list-style: none;
}

.links li {
  padding: 0px 6px;
}

.links a, .links a:visited {
  color: var(--text-color);
  text-decoration: underline dotted;
}
</style>
