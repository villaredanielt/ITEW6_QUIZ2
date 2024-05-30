<template>
  <div>
    <header class="header">
      <h1 style="color: #2196F3;">TrendShop</h1>
      <button class="add-button" @click="openModal('add')">Add Item</button>
    </header>
    
    <div class="item-container">
      <div v-for="item in items" :key="item.id" class="item-card">
        <div class="item">
          <div class="item-info">
            <h3>{{ item.name }}</h3>
            <p>Price: {{ item.price }}</p>
            <p>{{ item.description }}</p>
          </div>
          <div class="item-actions">
            <button @click="openModal('edit', item)">Edit</button>
            <button @click="openModal('delete', item)">Delete</button>
          </div>
        </div>
      </div>
    </div>

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
      { id: 1, name: 'Jogger Pants', price: 1000, description: 'Black and Gray Color' },
      { id: 2, name: 'Skirts', price: 500, description: 'Small-Large/Denim Style' },
      { id: 3, name: 'Polo Shirts', price: 3500, description: 'Unisex/ Black and Brown Color' },
      { id: 4, name: 'CropTops', price: 500, description: 'Fit to Small-Medium' },
      { id: 5, name: 'Tshirts', price: 1000, description: 'Small-Large/ Black Color' },
      { id: 6, name: 'Shorts', price: 500, description: 'Men Shorts/ Denim' },
      { id: 7, name: 'Hoodie', price: 3000, description: 'Oversized Hoodie' },
      { id: 8, name: 'Dress', price: 5000, description: 'Classy Dress/ White and Black Color' }
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

.item-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

.item-card {
  border: 1px solid #ddd;
  border-radius: 4px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.item {
  padding: 20px;
}

.item-info {
  margin-bottom: 15px;
}

.item-actions button {
  margin-right: 10px;
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
  border: none;
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
  background-color: #007bff;
  color: white;
  border: none;
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