<template>
  <article>
    <h1>Liste secrète des utilisateurs</h1>
    <section v-for="user in users" :key="user.id">
      <ul>
        <li>{{ user.id }}</li>
        <li>{{ user.email }}</li>
        <li>{{ user.phone_number }}</li>
      </ul>
    </section>
  </article>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { API_BASE_URL } from '../constants'
import globalState from '../state'

const users = ref([])

export default defineComponent({
  name: 'Users',
  setup () {
    return { users }
  },
  async beforeRouteEnter (to, from, next) {
    if (globalState.token === null) {
      console.error('You should be authenticated to be here!')
      return next('/')
    }

    let res
    try {
      res = await fetch(`${API_BASE_URL}/api/user`, {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${globalState.token}`
        }
      })
    } catch (err) {
      console.error(err)
      return next('/')
    }

    if (res.status !== 200) {
      console.error('You have no right to be here!')
      return next('/')
    }

    try {
      users.value = await res.json()
    } catch (err) {
      console.error(err)
      return next('/')
    }
  }
})
</script>

<style scoped>
article section {
  border-bottom: 1px dotted var(--border-color);
}
</style>
