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
        >
        <button @click="addUser">Add user</button>
    </div>
</template>

<script>
export default {
    name: "AddUsers",
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
        addUser() {
            this.$emit('userAdded', this.modelInput);
            this.modelInput = null;
        },
    },
}
</script>

<style scoped>

</style>
