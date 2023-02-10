<template>
    <div class="input">
        <label>{{ dataLabel }}</label>
        <br>
        <input
            v-model="modelInput"
            :required="required"
            :placeholder="dataPlaceholder"
            :name="dataName"
            :type="dataType"
            @input="onTextChange"
        >
    </div>
</template>

<script>
export default {
    name: 'InputText',

    props: {
        modelValue: [String, Number],
        dataLabel: String,
        dataName: String,
        dataType: String,
        dataPlaceholder: String,
        required: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            modelInput: this.modelValue,
        };
    },

    methods: {
        onTextChange() {
            this.$emit('textChange', this.modelInput);
        },
    },
};
</script>

<style lang="scss" scoped>

</style>
