<template>
    <router-view />
</template>

<script>
export default {
    name: 'App',
    mounted() {
        console.log(window.Laravel.user)
        if (!window.Laravel.user) {
            this.$router.push({
                name: 'login',
            });
        }
    },
};
</script>

<style lang="scss" scoped>

</style>
