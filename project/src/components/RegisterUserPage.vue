<template>
  <div class="registration-form">
    <h1>Create Account</h1>
    <form @submit.prevent="createAccount">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">Create Account</button>
  
      <p v-if="accountCreated" class="success-message">Account successfully created!</p>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'RegistrationForm',
  setup() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const router = useRouter();
    const accountCreated = ref(false); // Ref for tracking account creation status

    const createAccount = () => {
      setTimeout(() => {
        accountCreated.value = true;
        setTimeout(() => {
          router.push('/login');
        }, 3000); 
      }, 2000); 
    };

    return {
      name,
      email,
      password,
      createAccount,
      accountCreated 
    };
  }
};
</script>

<style scoped>
.registration-form {
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
  transition: background-color 0.5s ease;
}

button:hover {
  background-color: #1976D2;
}

.success-message {
  color: #4CAF50; 
  text-align: center;
}

@media (max-width: 768px) {
  .registration-form {
    padding: 15px;
  }
}
</style>
