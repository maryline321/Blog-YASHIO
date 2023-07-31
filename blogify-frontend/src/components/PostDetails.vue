<template>
  <div>
    <h2>All Posts</h2>
    <div v-if="loading">
      Loading...
    </div>
    <div v-else>
      <div v-if="error">
        Error fetching posts. Please try again later.
      </div>
      <div v-else>
        <div v-for="post in posts" :key="post.id">
          <h3>{{ post.title }}</h3>
          <p>{{ post.description }}</p>
          <div>
            <strong>Tags:</strong>
            <span v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PostList',
  data() {
    return {
      posts: null,
      loading: false,
      error: null,
    };
  },
  async created() {
    this.loading = true;
    try {
      const response = await this.fetchPosts();
      this.posts = response.data;
      this.loading = false;
    } catch (error) {
      console.error('Error fetching posts:', error);
      this.error = error.message;
      this.loading = false;
    }
  },
  methods: {
    async fetchPosts() {
      // Implement the API request to fetch posts here
      // For example, using axios.get('/api/posts')
    },
  },
};
</script>

<style>
/* Your CSS styles for PostList component */
</style>
