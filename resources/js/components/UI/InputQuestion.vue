<template>
    <div>
        <InputTextArea
            data-label="Add a question"
            data-placeholder="Enter a question"
            :model-value="question"
            @text-change="question = $event"
        />
    </div>
    <br>
    <div>
        <InputTextArea
            data-label="Add an answer"
            data-placeholder="Add an answer"
            :model-value="answer"
            @text-change="answer = $event"
        />
    </div>
    <br>
    <button @click="saveQA">Add Q&A</button>
    <br><br>
    {{ dataQA }}
</template>

<script>
import InputTextArea from "./InputTextArea.vue";
import {toRaw} from "vue";

export default {
    name: "InputQuestion",
    components: {
        InputTextArea,
    },
    data() {
        return {
            question: '',
            answer: '',
            dataQA: [],
        };
    },
    methods: {
      saveQA() {
        this.dataQA.push({question: this.question, answer: this.answer});
        this.$emit('addQA', this.dataQA);
        this.question = '';
        this.answer = '';
      }
    },
}
</script>

<style scoped>

</style>
