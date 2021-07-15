<template>
  <div>
    <div v-if="showAsSelect" class="text-center">
      <h3
          v-if="! hideSelectHeading"
          class="text-sm uppercase tracking-wide p-3 text-grey"
      >
        {{ filter.name }}
      </h3>

      <div class="p-2 pt-0">
        <select-control
            class="block w-full form-control-sm form-select"
            :value="value"
            @change="handleChange"
            :options="filter.options"
            label="name"
        >
          <option value="" selected>-- ALL --</option>
        </select-control>
      </div>
    </div>

    <card v-else class="overflow-hidden flex flex-row">
      <button
        v-for="option in filter.options"
        :key="option.value"
        class="py-4 px-8 border-b-2 focus:outline-none flex-1"
        :class="[isActive(option) ? 'text-grey-black font-bold border-primary': 'text-grey font-semibold border-40']"
        @click="handleChange(option)"
      >
        {{ option.name }}
      </button>
    </card>
  </div>
</template>

<script>
import InteractsWithQueryString from 'laravel-nova/src/mixins/InteractsWithQueryString'
import Filterable from 'laravel-nova/src/mixins/Filterable'

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
        filterKey: null
    }),

    created() {
        this.filterKey = this.card.filter
    },

    methods: {
        handleChange(option) {
          const option_value = this.showAsSelect ? option.target.value : option.value;

            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: option_value,
            })

            this.filterChanged()
        },

        isActive(option) {
            return String(this.value) == String(option.value)
        }
    },

    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
        },

        value() {
            return this.filter.currentValue
        },

        /**
         * Get the name of the page query string variable.
         */
        pageParameter() {
            return this.resourceName + '_page'
        },

        showAsSelect() {
          return this.card.show_as_select || false
        },

        hideSelectHeading() {
          return this.card.hide_select_heading || false
        },
    },
}
</script>
