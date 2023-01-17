<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-no-wrap items-center">
        <input
          v-model.number="form.priceFrom"
          type="text"
          placeholder="Price from"
          class="input-filter-l"
        />
        <input
          v-model.number="form.priceTo"
          type="text"
          placeholder="Price to"
          class="input-filter-r"
        />
      </div>
      <div class="flex flex-no-wrap items-center">
        <select v-model="form.beds" class="input-filter-l">
          <option :value="null">Beds</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="">6+</option>
        </select>
        <select v-model="form.bathrooms" class="input-filter-r">
          <option :value="null">Baths</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="">6+</option>
        </select>
      </div>
      <div class="flex flex-no-wrap items-center">
        <input
          v-model.number="form.areaFrom"
          type="text"
          placeholder="Area from"
          class="input-filter-l"
        />
        <input
          v-model.number="form.areaTo"
          type="text"
          placeholder="Area to"
          class="input-filter-r"
        />
      </div>

      <button type="submit" class="btn-primary">Filter</button>
      <button type="reset" @click="clear">Clear</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  filters: Object,
});

const form = useForm({
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  beds: props.filters.beds ?? null,
  bathrooms: props.filters.bathrooms ?? null,
  areaFrom: props.filters.areaFrom ?? null,
  areaTo: props.filters.areaTo ?? null,
});

const filter = () => {
  form.get(route("listing.index"), {
    preserveState: true,
    preserveScroll: true,
  });
};

const clear = () => {
  form.priceFrom = null;
  form.priceTo = null;
  form.beds = null;
  form.bathrooms = null;
  form.areaFrom = null;
  form.areaTo = null;

  filter();
};
</script>
