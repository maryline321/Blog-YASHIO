<template>
  <div>
    <h2 style="text-align:left;">Posts List</h2>

    <div class="post-container" v-for="post in posts" :key="post.id">
      <div class="post-section">
        <h5>{{ post.title }}</h5>
        <div v-if="isDescriptionLong(post.description)">
          <p class="description">{{ truncatedDescription(post.description) }}</p>
          <a @click="toggleDescription(post.id)">
            {{ post.id in expandedDescriptions ? 'Read less' : 'Read more' }}
          </a>
        </div>
        <div v-else>
          <p class="description">{{ post.description }}</p>
        </div>
        <p class="tag-button">{{ post.tags }}</p>

      </div>
    </div>
  </div>
</template>

<style>
.post-container {
  border: 1px solid #ccc;
  margin-bottom: 10px;
  padding: 10px;
  max-width: 100%; 
  margin: 0 auto; 
}

.post-section {
  background-color: #f7f7f7;
  padding: 10px;
  border-radius: 5px;
  text-align: left; 
}

.description {
  font-size: 12px;
  margin: 10px 0; 
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.tag{
   font-size: 12px;
  margin: 10px 0; 
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color:blue;
}

.tag-button {
   font-size: 12px;
  margin: 10px 0; 
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color:blue;
}





</style>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
      expandedDescriptions: {},
    };
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios
        .get("http://localhost:8000/api/posts")
        .then((response) => {
          this.posts = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    isDescriptionLong(description) {
      const descriptionElement = document.createElement("div");
      descriptionElement.innerHTML = description;
      return (
        descriptionElement.clientHeight < descriptionElement.scrollHeight ||
        descriptionElement.clientWidth < descriptionElement.scrollWidth
      );
    },
    truncatedDescription(description) {
      return description.slice(0, 100) + "...";
    },
    toggleDescription(postId) {
      if (this.expandedDescriptions[postId]) {
        this.$set(this.expandedDescriptions, postId, false);
      } else {
        this.$set(this.expandedDescriptions, postId, true);
      }
    },
   
  },
};
</script>
