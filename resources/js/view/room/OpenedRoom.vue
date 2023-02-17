<template>
    <div v-if="room">
        Welcome to {{ room.name }} room!
        <br>
        {{ roomUsers }}
        <br>
        {{ allJoined }}
        <br>
        <div v-if="!allJoined">
            <p>Wait for all the participants to join.</p>
            <ul>
                <li v-for="user in roomUsers.roomUsers">
                    {{ user.user_email }} => {{ user.active ? 'has joined' : 'waiting to join...'}}
                </li>
            </ul>
        </div>
        <br>
        <RoomQuestion v-if="allJoined"
            :room-users="roomUsers.roomUsers"
            :room="room"
        />

    </div>
</template>

<script>
import RoomQuestion from "../../components/RoomQuestion.vue";

export default {
    name: "OpenedRoom",
    components: {RoomQuestion},
    props: {
        link: {
            type: String,
            required: true,
        },
    },
    data () {
        return {
            room: null,
            roomUsers: null,
            allJoined: false,
            currentQuestion: null,
        }
    },
    computed: {
        user: () => {
            return window.Laravel.user || null;
        },
    },
    mounted() {
        this.getRoom();
        window.Echo.channel('roomParticipants')
            .listen('ParticipantJoined', (e) => {
                this.roomUsers = e;
                this.allJoined = this.getAllJoinedStatus();
            });

    },
    methods: {
        getRoom() {
            console.log(this.$route.params.link)
            this.axios.get(`/api/v1/room/open/${this.$route.params.link}/user/${this.user.email}`)
                .then(res => {
                    this.room = res.data.data;
                })
                .catch(err => {
                    this.$router.push({
                        name: '404',
                    });
                });
        },
        getAllJoinedStatus () {
            let userStatus = [];

            this.roomUsers.roomUsers.forEach(function (user) {
                userStatus.push(user.active);
            });
            //console.log(userStatus.every((value) => value == true))
            return userStatus.every((value) => value == true);
        }
    }
}
</script>

<style scoped>

</style>
