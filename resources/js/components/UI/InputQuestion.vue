<template>
    <div>
        <InputTextArea
            data-label="Add a question"
            data-placeholder="Enter a question"
            :model-value="question"
        />
    </div>
    <br>
    <div>
        <InputTextArea
            data-label="Add an answer"
            data-placeholder="Add an answer"
            :model-value="answer"
        />
    </div>
    <br>
    <button @click="save">Add Q&A</button>
</template>

<script>
import InputTextArea from "./InputTextArea.vue";

export default {
    name: "InputQuestion",
    components: {
        InputTextArea,
    },
    data() {
        return {
            question: '',
            answer: '',
        };
    },
    methods: {
      save() {
          
      }
    },
}
</script>

<style scoped>

</style>
