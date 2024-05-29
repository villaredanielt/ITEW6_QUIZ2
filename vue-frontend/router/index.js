import { createRouter, createWebHistory } from 'vue-router';
import LoginForm from '../src/components/LoginForm.vue';
import RegisterUserPage from '../src/components/RegisterUserPage.vue';
import Home from '../src/components/HomePage.vue';

const routes = [
    { path: '/', component: LoginForm },
    { path: '/register', component: RegisterUserPage },
    { path: '/home', component: Home }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
