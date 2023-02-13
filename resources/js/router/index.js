import {createRouter, createWebHistory} from 'vue-router';
import LoginView from '../view/LoginView.vue';
import HomeView from "../view/HomeView.vue";
import CreateRoom from "../view/room/CreateRoomView.vue";
import Home from "../view/Home.vue";
import RoomQuestionAddView from "../view/room/RoomQuestionAddView.vue";

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
                path: 'room/:roomId(\\d+)/question/add/',
                name: 'room.question.add',
                components: {
                    default: RoomQuestionAddView,
                }
            }
        ]
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
