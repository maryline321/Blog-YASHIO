<template>
  <div>
    <h2>Post Form</h2>
    <form @submit.prevent="submitPost">
      <label for="title">Title:</label>
      <input type="text" id="title" v-model="post.title" required>

      <label for="description">Description:</label>
      <textarea id="description" v-model="post.description" required></textarea>

      <label for="tags">Tags:</label>
      <input type="text" id="tags" v-model="post.tags" required>

      <button type="submit">Submit Post</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      post: {
        title: "",
        description: "",
        tags: "",
      },
    };
  },
  methods: {
    submitPost() {
      axios
        .post("http://localhost:8000/api/posts", this.post)
        .then((response) => {
          console.log(response.data);
          // Clear the form after successful submission
          this.post = {
            title: "",
            description: "",
            tags: "",
          };
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
