<template>
  <card class="overflow-hidden flex flex-row">
    <button
      v-for="option in filter.options"
      :key="option.value"
      class="py-4 px-8 border-b-2 focus:outline-none flex-1"
      :class="[
        isActive(option)
          ? getStatusStyle(option)
          : 'text-grey font-semibold border-40',
        statusStyle
      ]"
      @click="handleChange(option)"
    >
      {{ option.label }}
    </button>
  </card>
</template>

<script>
import InteractsWithQueryString from "@/mixins/InteractsWithQueryString";
import Filterable from "@/mixins/Filterable";

export default {
  mixins: [InteractsWithQueryString, Filterable],
  props: {
    card: {
      required: true,
    },
    resourceName: {
      type: String,
      required: true,
    },
  },

  data: () => ({
    filterKey: null,
  }),

  created() {
    this.filterKey = this.card.filter;
  },

  mounted() {
    this.$el.classList.remove("min-h-40");
  },

  methods: {
    handleChange(option) {
      this.$store.commit(`${this.resourceName}/updateFilterState`, {
        filterClass: this.filterKey,
        value: option.value,
      });

      this.$emit("change");
    },

    isActive(option) {
      return String(this.value) == String(option.value);
    },

    getStatusStyle(option) {
      switch (String(option.value)) {
        case "pending":
          return "text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm dark:focus:ring-yellow-900";

        case "active":
          return "text-white bg-purple-700 hover:bg-purple-800 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900";

        case "delivered":
          return "text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";

        case "canceled":
          return "focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";
      }
    },
  },

  computed: {
    filter() {
      return this.$store.getters[`${this.resourceName}/getFilter`](
        this.filterKey
      );
    },

    value() {
      return this.filter.currentValue;
    },

    /**
     * Get the name of the page query string variable.
     */
    pageParameter() {
      return this.resourceName + "_page";
    },
    
  },
};
</script>
