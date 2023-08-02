<template>
  <div v-if="!submitted" class="form-overlay" @click="toggleForm()">
    <div class="form-content" @click.stop>
      <button class="close" @click="toggleForm()">Close</button>
      <h2>Create Post</h2>

      <div class="main-block">
        <form @submit.prevent="postSubmit">
          <div class="info">
            <input class="fname" type="text" name="title" id="title" v-model="title" placeholder="Enter Title" required
              @click.stop
            />
          </div>
          <div>
            <textarea rows="4" v-model="description" placeholder="Enter Description" required @click.stop></textarea>
          </div>
          <input class="fname" type="text" name="tags" id="tags" v-model="tags" placeholder="Enter Tags" required
            @click.stop
          />
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
const submitted = ref(false) // New state variable to track form submission

const postSubmit = async () => {
  try {
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

    const response = await axios(config)

    redirectToPost()

    console.log('Response:', response.data)

    submitted.value = true;

    // Clear form fields after successful submission
    title.value = '';
    description.value = '';
    tags.value = '';
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
  background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999; /* Ensure the overlay is on top of other elements */
}

.form-content {
  width: 80%; /* Adjust the width as needed */
  max-width: 600px; /* Set a maximum width if desired */
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
  /* Adjust the width as needed */
  width: 100%;
}

form {
  /* Adjust the width as needed */
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
}
.close {
  width: fit-content; /* Reduce width to fit the button content */
  padding: 8px 12px; /* Adjust padding for a smaller button */
  position: absolute;
  bottom: 100px; /* Adjust bottom positioning to place it in the bottom-right corner */
  right: 360px; /* Adjust right positioning to place it in the bottom-right corner */
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
  .fa-envelope {
    margin-top: 0;
    margin-left: 20%;
  }
  .fa-at {
    margin-top: -10%;
    margin-left: 65%;
  }
  .fa-mail-bulk {
    margin-top: 2%;
    margin-left: 28%;
  }
}
</style>
