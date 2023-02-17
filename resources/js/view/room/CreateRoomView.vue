<template>
    <div>
        Fill out the form:
    </div>
    <br><br>
    <div>
        <InputText
            data-type="text"
            data-label="Enter room's name"
            :model-value="room.name"
            @text-change="room.name = $event"
        />
    </div>
    <br>
    <div>
        <InputText
            data-type="text"
            data-label="Enter start date"
            :model-value="room.start_on"
            @text-change="room.start_on = $event"
        />
    </div>
    <br>
    <div>
        <InputText
            data-type="text"
            data-label="Enter close date"
            :model-value="room.close_on"
            @text-change="room.close_on = $event"
        />
    </div>
    <br>
    <div>
        <InputText
            data-type="text"
            data-label="Enter open time"
            :model-value="room.open_at"
            @text-change="room.open_at = $event"
        />
    </div>
    <br>
    <div>
        <AddUsers
            data-type="text"
            data-label="Add users to the room"
            data-placeholder="enter user's email"
            :model-value="user"
            @user-added="room.users.push($event)"
        />
    </div>
    <br>
    {{ room.users }}
    <br><br>
    <input-question
        @add-question="room.questions = $event"
    />
    <br>
    {{ room.questions }}
    <br><br>
    <button @click="save">Create room</button>
    <br><br>
    {{ info }}

</template>

<script>
    import InputText from "../../components/UI/InputText.vue";
    import AddUsers from "../../components/UI/AddUsers.vue";
    import {toRaw} from "vue";
    import InputQuestion from "../../components/UI/InputQuestion.vue";

    export default {
        name: 'CreateRoom',
        components: {
            InputQuestion,
            AddUsers,
            InputText,
        },
        data () {
            return {
                room: {
                    users: [],
                    questions: [],
                },
                user: null,
                //users: [],
                info: null,
            }
        },
        methods: {
            save() {
                const roomData = {
                    ...this.room,
                    creator_id: window.Laravel.user.id,
                };
                this.promiseHandling(this.axios.post(`/api/v1/rooms/`, roomData));  ///api/v1/rooms/
            },
            promiseHandling(promise) {
                promise
                    .then((res) => {
                        if (res.data?.data?.id) {
                            this.$router.push({
                                name: 'home',
                                /*
                                params: {
                                    roomId: res.data.data.id,
                                },

                                 */
                            });
                        }
                    })
                    .catch(() => {
                        console.log('Could not create a new room');
                    });
            },
        },
    };
</script>
