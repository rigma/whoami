<template>
  <nav class="links">
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
