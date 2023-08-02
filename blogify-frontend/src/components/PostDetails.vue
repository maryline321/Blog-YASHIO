<template>
  <div @click="handlePostClick">
    <h5 v-if="post && post.title">{{ post.title }}</h5>
    <p v-if="post && post.description" class="descr">{{ post.description }}</p>
    <p v-if="post && post.tags" class="tag-button">{{ post.tags }}</p>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  methods: {
    handlePostClick() {
      this.$emit("post-clicked", this.post);
    },
  },
};
</script>
