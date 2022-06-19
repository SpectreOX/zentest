import { createRouter, createWebHistory } from 'vue-router';
import SnippetsIndex from '../Home/SnippetsIndex'
import LinksIndex from '../Home/LinksIndex'
import FilesIndex from '../Home/FilesIndex'

const routes = [
    {
        path: '/',
        name: 'snippets',
        component: SnippetsIndex,
    },
    {
        path: '/files',
        name: 'files',
        component: FilesIndex,
    },
    {
        path: '/links',
        name: 'links',
        component: LinksIndex,
    },
    
    
]
export default createRouter({
    history : createWebHistory(),
    routes
});

