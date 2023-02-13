<template>
    Hello from new room number {{ roomId }}
</template>

<script>
export default {
    name: "RoomQuestionAddView",

    props: {
        roomId: {
            type: String,
            required: true,
        },
    },
}
</script>

<style scoped>

</style>
