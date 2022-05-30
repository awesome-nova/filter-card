<template>
  <card class="overflow-hidden flex flex-row">
    <button
      v-for="option in filter.options"
      :key="option.value"
      class="py-4 px-8 border-b-2 focus:outline-none flex-1"
      :class="[
        isActive(option)
          ? getUnderlineStyle(option)
          : 'text-grey font-semibold border-40',
        getStatusStyle(option)
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
          return "hover:text-white hover:bg-yellow-600 font-medium text-sm dark:focus:ring-yellow-900";

        case "active":
          return "hover:text-white hover:bg-purple-800 font-medium text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900";

        case "delivered":
          return "hover:text-white hover:bg-green-800 font-medium text-sm dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";

        case "canceled":
          return "hover:text-white hover:bg-red-800 font-medium text-sm dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";
      }
    },

    getUnderlineStyle(option) {
      switch (String(option.value)) {
        case "pending":
          return "border-b-4 border-yellow-600 border-solid ";

        case "active":
          return "border-b-4 border-purple-800 border-solid";

        case "delivered":
          return "border-b-4 border-green-800 border-solid";

        case "canceled":
          return "border-b-4 border-red-800 border-solid";
      }
    }
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
