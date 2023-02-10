<template>
    <<div class="input">
        <label>{{ dataLabel }}</label>
        <br>
        <textarea
            v-model="localModelValue"
            :placeholder="dataPlaceholder"
            :name="dataName"
            @input="onTextChange"
        ></textarea>
    </div>
</template>

<script>
export default {
    name: "InputTextArea",

    props: {
        dataLabel: String,
        dataPlaceholder: String,
        dataName: String,
        modelValue: String,
    },
    data() {
        return {
            localModelValue: this.modelValue,
        };
    },
};

</script>

<style scoped>

</style>
