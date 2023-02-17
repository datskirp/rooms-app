<template>
    {{ roomUsers }}
    <hr>
    Question {{ start+1 }}:
    <p>{{ room.questions[start].question }}</p>
    <div v-if="allAnswered">
        <p>Correct answer:</p>
        <p>{{ room.question[start].answer }}</p>
        <button @click="nextQuestion">Continue to next question</button>
    </div>
    <hr>
    <div v-if="answered && !allAnswered">
        Waiting for others to answer...
    </div>
    <div v-if="!answered">
        <input-text-area
            data-label="Enter your answer"
            data-placeholder="Enter an answer"
            :model-value="answer"
            @text-change="answer = $event"
        />
        <button @click="saveAnswer">Submit answer</button>
    </div>
    <br>
    {{ returnData }}
    <br>
    {{ answers }}
</template>

<script>
import InputTextArea from "./UI/InputTextArea.vue";
export default {
    name: "RoomQuestion",
    components: {InputTextArea},
    props: {
        room: Array,
        roomUsers: Array,
    },
    data() {
        return {
            questionsCount: this.room.questions.length,
            start: 0,
            answer: '',
            returnData: [],
            answers: [],
            answered: false,
            allAnswered: false,
        };
    },
    mounted() {

        window.Echo.channel('answers')
            .listen('UserAnswerSubmitted', (e) => {
                this.answers = e;
                this.allAnswered = this.checkAllAnswers();
            });

    },
    methods: {
        checkAllAnswers() {
          if(this.roomUsers.roomUsers.length === this.answers.answers.length){
              return true;
          }
        },
        nextQuestion(){
          this.start++;
          this.answered = false;
          this.allAnswered = false;

        },
        saveAnswer() {
            const roomData = {
                room_id: this.room.id,
                answer: this.answer,
                question_id: this.room.questions[this.start].id,
                users: this.room.auth_participants,
                user_id: window.Laravel.user.id,
            };
            this.promiseHandling(this.axios.post(`/api/v1/answers/`, roomData));
            this.answered = true;
        },
        promiseHandling(promise) {
            promise
                .then((res) => {
                    if (res.data?.data?.id) {
                        this.returnData = res.data.data;
                    }
                })
                .catch(() => {
                    console.log('Could not upload an answer');
                });
        },
    },

}
</script>

<style scoped>

</style>
