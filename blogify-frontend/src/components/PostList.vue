<template>
  <div>
    <h2 style="text-align: left;">Posts List</h2>

    <div v-if="posts.length === 0">No posts available.</div>

    <div v-else>
      <!-- Use IndividualPost component to display each post -->
      <PostDetails
        v-for="post in posts"
        :key="post.id"
        :post="post"
        @post-clicked="viewPost"
        class="post-container"
      />
    </div>
 <!-- Modal to show the individual post -->
 <div v-if="selectedPost">
  <div class="modal">
    <button class="close-button" @click="closePost">Close</button>
    <div class="modal-content">
      <h2>{{ selectedPost.title }}</h2>
      <p class="description">{{ selectedPost.description }}</p>
      <p class="tag-button">{{ selectedPost.tags }}</p>
    </div>
  </div>
  <div class="modal-overlay" @click="closePost"></div>
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
  cursor: pointer;
  text-align: left; 
}

.modal {
  position: fixed;
  top: 50%; 
  left: 50%; 
  transform: translate(-50%, -50%); 
  background-color: #f7f7f7;
  padding: 20px;
  border-radius: 5px;
  z-index: 9999; 
  width: 80%; 
  max-width: 600px; 
  height: 70%; 
  max-height: 80vh; 

}
.modal-content {
  text-align: left; 
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 9998; /* Ensure the overlay is above other content, but below the modal */
}
.close-button {
  position: absolute;
  top: 10px; /* Adjust the top position as needed */
  left: 550px; /* Adjust the left position as needed */
  background-color: blue;
  border: 1px solid;
  cursor: pointer;
  font-size: 12px;
}

.tag-button {
  /* Add styles for the hover effect */
  color: blue; /* Set the default text color */
  cursor: pointer;
  transition: color 0.2s; 
  font-size: 12px;/* Add a smooth transition effect on color change */
}

.tag-button:hover {
  color: blue; /* Set the text color to blue on hover */
}
.description {
  font-size: 14px; /* Set the font size to 12 pixels */
  
  margin: 10px 0;

  white-space: normal;
}
.descr{
  font-size: 12px; /* Set the font size to 12 pixels */
  margin: 10px 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>

<script>
import axios from "axios";
import PostDetails from "./PostDetails.vue"; 

export default {
  components: {
    PostDetails,
  },
  data() {
    return {
      posts: [],
      expandedDescriptions: {},
      selectedPost: null,
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
    handleTagClick(tag) {
      console.log("Tag clicked:", tag);
    },
    viewPost(post) {
      this.selectedPost = post;
    },
    closePost() {
      this.selectedPost = null;
    },
  },
};
</script>