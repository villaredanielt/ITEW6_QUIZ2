<template>
  <div>
    <header class="header">
      <h1>BetaMart</h1>
      <button class="add-button" @click="openModal('add')">Add Item</button>
    </header>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td>{{ item.name }}</td>
          <td>{{ item.price }}</td>
          <td>{{ item.description }}</td>
          <td>
            <button @click="openModal('edit', item)">Edit</button>
            <button @click="openModal('delete', item)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="isModalOpen" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <h2>{{ modalTitle }}</h2>
        <div v-if="modalType !== 'delete'">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="modalData.name" />
          <label for="price">Price:</label>
          <input type="number" id="price" v-model="modalData.price" />
          <label for="description">Description:</label>
          <textarea id="description" v-model="modalData.description"></textarea>
        </div>
        <div v-else>
          <p>Are you sure you want to delete this item?</p>
        </div>
        <button @click="handleSubmit">{{ modalButton }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'HomePage',
  setup() {
    const items = ref([
      { id: 1, name: 'Item 1', price: 10, description: 'Description 1' },
      { id: 2, name: 'Item 2', price: 20, description: 'Description 2' },
      { id: 3, name: 'Item 3', price: 30, description: 'Description 3' },
    ]);

    const isModalOpen = ref(false);
    const modalType = ref('');
    const modalTitle = ref('');
    const modalButton = ref('');
    const modalData = ref({ id: null, name: '', price: null, description: '' });

    const openModal = (type, item = null) => {
      modalType.value = type;
      isModalOpen.value = true;
      if (type === 'add') {
        modalTitle.value = 'Add Item';
        modalButton.value = 'Add';
        modalData.value = { id: null, name: '', price: null, description: '' };
      } else if (type === 'edit') {
        modalTitle.value = 'Edit Item';
        modalButton.value = 'Save';
        modalData.value = { ...item };
      } else if (type === 'delete') {
        modalTitle.value = 'Delete Item';
        modalButton.value = 'Delete';
        modalData.value = { ...item };
      }
    };

    const closeModal = () => {
      isModalOpen.value = false;
    };

    const handleSubmit = () => {
      if (modalType.value === 'add') {
        const newItem = { id: items.value.length + 1, ...modalData.value };
        items.value.push(newItem);
      } else if (modalType.value === 'edit') {
        const index = items.value.findIndex(item => item.id === modalData.value.id);
        if (index !== -1) {
          items.value[index] = { ...modalData.value };
        }
      } else if (modalType.value === 'delete') {
        items.value = items.value.filter(item => item.id !== modalData.value.id);
      }
      closeModal();
    };

    return {
      items,
      isModalOpen,
      modalType,
      modalTitle,
      modalButton,
      modalData,
      openModal,
      closeModal,
      handleSubmit,
    };
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #ddd;
}

.add-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 4px;
}

.add-button:hover {
  background-color: #0056b3;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

button {
  margin: 5px;
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  background-color: #0056b3;
}

.modal {
  display: flex;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #888;
  width: 90%;
  max-width: 500px;
  text-align: center;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

label {
  display: block;
  margin: 10px 0 5px;
}

input[type="text"],
input[type="number"],
textarea {
  width: 100%;
  padding: 8px;
  margin: 5px 0 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  margin: 10px 5px 0;
  padding: 10px 20px;
  cursor: pointer;
}

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
  }

  .add-button {
    padding: 8px 16px;
  }

  table {
    font-size: 14px;
  }
}
</style>
