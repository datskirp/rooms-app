import {createRouter, createWebHistory} from 'vue-router';
import LoginView from '../view/LoginView.vue';
import HomeView from "../view/HomeView.vue";
import CreateRoom from "../view/room/CreateRoomView.vue";
import Home from "../view/Home.vue";
import OpenedRoom from "../view/room/OpenedRoom.vue";
import NotFound from "../view/NotFound.vue";

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
            },
            {
                path: 'room/open/:link/',
                name: 'room.open',
                components: {
                    default: OpenedRoom,
                }
            }
        ]
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
