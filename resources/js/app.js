import 'bootstrap'
import "bootstrap/dist/css/bootstrap.min.css"
import {createApp} from 'vue'
import App from './Layouts/App'
import router from './routes/router'
import copyText from "@meforma/vue-copy-to-clipboard";


const app = createApp(App)
app.use(router)
app.use(copyText)
app.mount('#app')