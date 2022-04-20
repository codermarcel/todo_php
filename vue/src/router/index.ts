import { createRouter, createWebHistory } from 'vue-router'
import All from '../views/All.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'all',
      component: All
    },
    {
      path: '/finished',
      name: 'finished',
      component: () => import('../views/Finished.vue')
    },
    {
      path: '/unfinished',
      name: 'unfinished',
      component: () => import('../views/Unfinished.vue')
    }
  ]
})

export default router
