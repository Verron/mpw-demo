import {createRouter, createWebHistory} from 'vue-router'
import ListView from '../views/ListView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: ListView
        },
        {
            path: '/create',
            name: 'create',
            component: () => import('../views/CreateView.vue')
        },
        {
            path: '/:id',
            name: 'event',
            component: () => import('../views/EditView.vue')
        }
    ]
})

export default router
