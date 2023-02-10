import {createRouter, createWebHistory} from 'vue-router';
import LoginView from '../view/LoginView.vue';
import HomeView from "../view/HomeView.vue";
import CreateRoom from "../components/CreateRoom.vue";
import Home from "../components/Home.vue";

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginView,
  },
    {
        path: '/',
        component: HomeView,
        children: [
            {
                path: 'home',
                name: 'home',
                components: {
                    default: Home,
                }
            },
            {
                path: 'room/add',
                name: 'room.add',
                components: {
                    default: CreateRoom,
                },
            }]
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
