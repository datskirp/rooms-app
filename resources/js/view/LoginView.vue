<template>
  <div class="container">
    <div class="cv-login-page">
        Hello!
      <form
        v-if="!user"
        method="GET"
        action="/login/google"
      >
        <div class="row mt-3">
          <div class="col-md-8 offset-md-4">
            <button
              type="submit"
              class="btn btn-danger"
            >
              <i class="fab fa-google-f fa-fw" />Auth with Google
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginView',
  computed: {
    user: () => {
      return window.Laravel.user || null;
    },
  },

  mounted() {
    if (window.Laravel.user) {
      this.$router.push({
        name: 'room.add',
      });
    }
  },
};
</script>

<style lang="scss" scoped>

</style>
