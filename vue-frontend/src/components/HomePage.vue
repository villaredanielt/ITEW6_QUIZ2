<template>
    <div>
      <h1>BertMart</h1>
      <button @click="openModal('add')">Add Item</button>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
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
            { id: 1, name: 'Item 1' },
            { id: 2, name: 'Item 2' },
            { id: 3, name: 'Item 3' },
        ]);
    
        const isModalOpen = ref(false);
        const modalType = ref('');
        const modalTitle = ref('');
        const modalButton = ref('');
        const modalData = ref({ id: null, name: '' });
    
        const openModal = (type, item = null) => {
            modalType.value = type;
            isModalOpen.value = true;
            if (type === 'add') {
            modalTitle.value = 'Add Item';
            modalButton.value = 'Add';
            modalData.value = { id: null, name: '' };
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
    border: 1px solid #888;
    width: 300px;
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
</style>
