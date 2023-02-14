<template>
    <div>
        <SelectComponent
            data-label="Question type"
            data-placeholder="Select type"
            :data-array="types"
            data-name="questionType"
            :required="true"
            :model-value="type"
            @input="type = $event"
        />
    </div>
    <br>
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
</template>

<script>
import InputTextArea from "./InputTextArea.vue";
import {toRaw} from "vue";
import SelectComponent from "./SelectComponent.vue";

export default {
    name: "InputQuestion",
    components: {
        SelectComponent,
        InputTextArea,
    },
    data() {
        return {
            question: '',
            answer: '',
            types: {
                'Text': 1,
                'Code': 2,
                'Checkbox': 3,
                'Radio': 4,
            },
            type: '',
            dataQA: [],
        };
    },
    emits: ['addQA'],
    methods: {
      saveQA() {
        this.dataQA.push({question: this.question, answer: this.answer, type: this.type, user_id: window.Laravel.user.id});
        this.$emit('addQuestion', this.dataQA);
        this.question = '';
        this.answer = '';
      }
    },
}
</script>

<style scoped>

</style>
