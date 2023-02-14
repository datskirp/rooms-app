<template>
  <label class="select">
    {{ dataLabel }}
    <select
      v-model="selected"
      :value="dataSelected"
      :name="dataName"
      class="input"
      required
      @change="emitSelected"
    >
      <option
        v-if="dataPlaceholder"
        value=""
        selected
        disabled
      >{{ dataPlaceholder }}
      </option>
      <option
        v-for="item in Object.keys(dataArray)"
        :key="item"
        :value="item"
      >
        {{ item }}
      </option>
    </select>
  </label>
</template>

<script>
export default {
  name: 'SelectComponent',
  props: {
    dataArray: {
      type: Object,
      default() {
        return {};
      },
    },
    dataSelected: {
      type: [String, Number],
      default: 0,
    },
    dataName: {
      type: String,
      default: '',
    },
    dataLabel: {
      type: String,
      default: '',
    },
    dataPlaceholder: {
      type: String,
      default: '',
    },
  },
  emits: [
    'input',
  ],
  data() {
    return {
      selected: '',
    };
  },
  methods: {
    emitSelected() {
      this.$emit('input', this.dataArray[this.selected]);
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
