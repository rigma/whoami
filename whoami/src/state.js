import { reactive } from 'vue'

export default reactive({
  token: null,
  sessionExpired: false,
  warningCount: 0
})
