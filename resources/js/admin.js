import { createRouter, createWebHistory } from 'vue-router';
import {createApp} from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import SnippetComponent from './Components/Snippets'
import LinkComponent from './Components/Links'
import FileComponent from './Components/Files'

import Admin from './Layouts/Admin'

const routes = [
    {
        path: '/admin',
        name: 'files',
        component: FileComponent,
    },
    {
        path: '/admin/snippets',
        name: 'snippets',
        component: SnippetComponent,
    },
    {
        path: '/admin/links',
        name: 'links',
        component: LinkComponent,
    },
    
]
const router =  createRouter({
    history : createWebHistory(),
    routes
});

const app = createApp(Admin)
app.use(router)
app.use(VueSweetalert2)
app.mount('#admin')