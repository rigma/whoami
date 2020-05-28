<template>
  <nav>
    <ul>
      <li>
        <router-link to="/">Accueil</router-link>
      </li>
      <li>
        <router-link to="/connexion">Se connecter</router-link>
      </li>
      <li>
        <router-link to="/s-inscrire">S'inscrire</router-link>
      </li>
    </ul>
  </nav>
  <main>
    <router-view />
  </main>
</template>

<script>
export default {
  name: 'App'
}
</script>
