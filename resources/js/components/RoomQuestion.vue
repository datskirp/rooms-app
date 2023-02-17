<template>
    <hr>
    Question {{ start }}:
    <p>{{ room.questions[start].question }}</p>
    <hr>
    <input-text-area
        data-label="Enter your answer"
        data-placeholder="Enter an answer"
        :model-value="answer"
        @text-change="answer = $event"
    />
    <button @click="saveAnswer">Submit answer</button>
</template>

<script>
import InputTextArea from "./UI/InputTextArea.vue";
export default {
    name: "RoomQuestion",
    components: {InputTextArea},
    props: {
        room: Array,
    },
    data() {
        return {
            questionsCount: this.room.questions.length,
            start: 1,
            answer: '',
        };
    },
    methods: {
        saveAnswer() {
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

}
</script>

<style scoped>

</style>
