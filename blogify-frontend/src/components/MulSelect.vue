<template>
    <div>
      <PostForm :options="options" :selected.sync="selected" />
      
    </div>
  </template>
  
  <script>

import PostForm from './PostForm.vue';
  
  export default {
    components: {
    PostForm
},
    data() {
      return {
        options: [], 
        selected: [], 
      };
    },
  };
  </script>
  