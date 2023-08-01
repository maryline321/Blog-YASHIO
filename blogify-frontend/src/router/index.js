import { createRouter, createWebHistory } from 'vue-router';
import PostList from '@/components/PostList.vue';
import PostForm from '@/components/PostForm.vue';
import PostDetails from '../components/PostDetails.vue';

const routes = [
 
  {
    path: '/',
    component: PostList,
  },
  {
    path: '/addpost',
    name:'createPost',
    component: PostForm,
  },
  {
    path: '/post/:id',
    component: PostDetails,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
