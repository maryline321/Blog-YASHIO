<template>
  <div>
    <div @click="handlePostClick">
      <h5 v-if="post && post.title">{{ post.title }}</h5>
      <p v-if="post && post.description" class="descr">{{ post.description }}</p>
      <!-- <p v-if="post && post.tag_id" class="tag-button">{{ post.tags.name }}</p> -->
      <!-- <button v-if="post && post.tag_id" class="tag-button">{{ post.tags.name }}</button> -->
  
    </div>
    <a v-if="post && post.tag_id" class="tag-button" :href="`/tags/${post.tag_id}`">{{ post.tags.name }}</a>
  </div>



</template>

<script>
import { useRouter } from 'vue-router';

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
    filter(tag){
      const router = useRouter()
      router.push('/tags/'+tag)
    }
  },
};
</script>
