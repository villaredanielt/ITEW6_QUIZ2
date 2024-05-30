<template>
  <div class="login-form">
    <h1>Login</h1>
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <p class="mt-3">Don't have an account? <router-link to="/register" class="link-sign">Sign Up Here!</router-link></p>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'LoginForm',
  setup() {
    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const handleSubmit = () => {
      if (email.value === 'admin@gmail.com' && password.value === 'admin') {
        router.push('/home');
      } else {
        alert('Invalid credentials');
      }
    };

    return {
      email,
      password,
      handleSubmit
    };
  }
};
</script>

<style scoped>
.login-form {
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
}

h1 {
  text-align: center;
  color: #2196F3;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #2196F3;
}

input {
  width: 90%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #2196F3;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #1976D2;
}

.link-sign {
  color: #2196F3;
  text-decoration: none;
}

.link-sign:hover {
  text-decoration: underline;
}

.mt-3 {
  margin-top: 15px;
}
</style>
