<template>
    <div>
      <h1>Create Account</h1>
      <form @submit.prevent="createAccount">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="password" required />
        </div>
        <div>
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
  
  
  <style scoped>
  /* Add some basic styling */
  form {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin: auto;
  }
  
  div {
    margin-bottom: 10px;
  }
  
  label {
    margin-bottom: 5px;
  }
  
  input {
    padding: 8px;
    font-size: 14px;
  }
  
  button {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #45a049;
  }
  
  .error {
    color: red;
    margin-top: -10px;
    margin-bottom: 10px;
  }
  </style>
  