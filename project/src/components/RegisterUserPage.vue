<template>
    <div class="card">
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
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" v-model="confirmPassword" required />
        </div>
        <div v-if="errorMessage" class="error">
          {{ errorMessage }}
        </div>
        <button type="submit">Create Account</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        errorMessage: ''
      };
    },
    methods: {
      async createAccount() {
        if (this.password !== this.confirmPassword) {
          this.errorMessage = 'Passwords do not match';
          return;
        }
  
        try {
          const response = await axios.post('/api/register', {
            name: this.name,
            email: this.email,
            password: this.password
          });
          console.log('Account created:', response.data);
          this.errorMessage = '';
          // Handle successful account creation, e.g., redirect to login page
        } catch (error) {
          console.error('Error creating account:', error);
          if (error.response && error.response.data && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = 'An error occurred while creating the account.';
          }
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add some basic styling */
  .card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Added shadow */
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    box-sizing: border-box; /* Ensure padding and border are included in the element's total width and height */
  }
  
  h1 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #45a049;
  }
  
  .error {
    color: red;
    text-align: center;
    margin-top: -10px;
    margin-bottom: 10px;
  }
  
  /* Responsive design */
  @media (max-width: 600px) {
    .card {
      margin: 20px;
      padding: 15px;
    }
  
    h1 {
      font-size: 1.5em;
    }
  
    input {
      font-size: 12px;
      padding: 8px;
    }
  
    button {
      padding: 8px;
    }
  }
  </style>
  