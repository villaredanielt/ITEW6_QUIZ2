import { createRouter, createWebHistory } from 'vue-router';
import LoginForm from '../src/components/LoginForm.vue';
import HomePage from '../src/components/HomePage.vue';

const routes = [
    { path: '/', component: LoginForm },
    { path: '/home', component: HomePage }
    ];

    const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
