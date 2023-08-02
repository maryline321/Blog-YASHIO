<template>
  <div v-if="!submitted" class="form-overlay" @click="toggleForm()">
    <div class="form-content" @click.stop>
      <button class="close" @click="toggleForm()">Close</button>
      <h2>Create Post</h2>

      
      <div v-if="successMessage" class="success-message">
        {{ successMessage }}
      </div>

      <div class="main-block">
        <form @submit.prevent="postSubmit">

          <div class="form-group">
            <label for="title" class="label">Title:</label>
            <input class="fname" type="text" name="title" id="title" v-model="title" placeholder="Enter Title" @click.stop />
            <div v-if="errors.title" class="error-message">{{ errors.title }}</div>
          </div>

          <div class="form-group">
            <label for="description" class="label">Description:</label>
            <textarea rows="4" v-model="description" id="description" placeholder="Enter Description" @click.stop></textarea>
            <div v-if="errors.description" class="error-message">{{ errors.description }}</div>
          </div>

          <div class="form-group">
            <label for="tags" class="label">Tags:</label>
            <input class="fname" type="text" name="tags" id="tags" v-model="tags" placeholder="Enter Tags" @click.stop />
            <div v-if="errors.tags" class="error-message">{{ errors.tags }}</div>
          </div>

          <button type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const redirectToPost = () => {
  router.push('/')
}

const title = ref('')
const description = ref('')
const tags = ref('')
const submitted = ref(false) 
const successMessage = ref('') 
const errors = ref({}) 

const postSubmit = async () => {
  
  errors.value = {}

  try {
    
    if (!title.value.trim()) {
      errors.value.title = 'Title field is required!.'
    }

    if (!description.value.trim()) {
      errors.value.description = 'Description field is required!.'
    }

    if (!tags.value.trim()) {
      errors.value.tags = 'Tags field is required!.'
    }

  
    if (Object.keys(errors.value).length > 0) {
      return 
    }

    let config = {
      method: 'post',
      url: 'http://127.0.0.1:8000/api/addpost',
      headers: {
        'Content-Type': 'application/json'
      },
      data: {
        title: title.value,
        description: description.value,
        tags: tags.value
      }
    }

    await axios(config)

    redirectToPost()

    successMessage.value = 'Post submitted successfully!';

    
    title.value = '';
    description.value = '';
    tags.value = '';

    submitted.value = true; 
  } catch (error) {
    console.error('Error:', error)
  }
}

const toggleForm = () => {
  submitted.value = !submitted.value;
}
</script>



<style scoped>
.form-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6); 
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999; 
}

.form-content {
  width: 80%; 
  max-width: 600px; 
  padding: 25px;
  box-shadow: 0 2px 5px #f5f5f5;
  background: #ffffff;
}

.main-block {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 60vh;
  width: 100%;
}

form {
  width: 100%;
  padding: 25px;
  margin: 25px;
  box-shadow: 0 2px 5px #f5f5f5;
  background: #ffffff;
}

.fas {
  margin: 25px 10px 0;
  font-size: 72px;
  color: #fff;
}

.fa-envelope {
  transform: rotate(-20deg);
}

.fa-at,
.fa-mail-bulk {
  transform: rotate(10deg);
}

input,
textarea {
  width: calc(100% - 18px);
  padding: 8px;
  margin-bottom: 20px;
  border: 1px solid #1c87c9;
  outline: none;
}

input::placeholder {
  color: #666;
}

button {
  width: 100%;
  padding: 10px;
  border: none;
  background: #1c87c9;
  font-size: 16px;
  font-weight: 400;
  color: #fff;
  cursor: pointer; 
}

.close {
  width: fit-content; 
  padding: 8px 12px; 
  position: absolute;
  bottom: 80px;
  right: 450px; 
  border: none;
  background: #c9331c;
  font-size: 16px;
  font-weight: 400;
  color: #fff;
}

.close:hover {
  background: #a02323;
}

button:hover {
  background: #2371a0;
}

@media (min-width: 568px) {
  .main-block {
    flex-direction: row;
  }

  .left-part,
  form {
    width: 50%;
  }

}

.success-message {
  margin-top: 10px;
  color: #3c763d;
  background-color: #dff0d8;
  border: 1px solid #d0e9c6;
  padding: 10px;
  border-radius: 5px;
}

.error-message {
  margin-bottom: 5px;
  color: #b80000;
}
.label{
  font-size: 12px;
  text-align: left;
}
</style>
