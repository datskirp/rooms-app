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
            @user-added="users.push($event)"
        />
    </div>
    <br>
    {{ users }}
    <br><br>
    <button @click="save">Create room</button>




</template>

<script>
    import InputText from "./UI/InputText.vue";
    import AddUsers from "./UI/AddUsers.vue";

    export default {
        name: 'CreateRoom',
        components: {
            AddUsers,
            InputText,
        },
        data () {
            return {
                room: {},
                user: null,
                users: [],
            }
        },
        methods: {
            save() {
                this.room.users = this.users
                this.axios.post(`/api/v1/rooms/`, this.room)
                    .then(() => {
                        this.$router.push({
                            name: 'home',
                        });
                    })
                    .catch(error => {
                        console.log(error.message);
                    });
            },
        },
    };
</script>
