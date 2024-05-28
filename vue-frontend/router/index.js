import { createRouter, createWebHistory } from 'vue-router';
import LoginForm from '../components/LoginForm.vue';
import RegisterUserPage from '../components/RegisterUserPage.vue';
import Home from '../components/Home.vue';

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
