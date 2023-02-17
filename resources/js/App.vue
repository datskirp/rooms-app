<template>
    <router-view />
</template>

<script>
export default {
    name: 'App',
    mounted() {
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
