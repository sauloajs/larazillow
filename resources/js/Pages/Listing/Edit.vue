<template>
  <form @submit.prevent="update">
    <div>
      <label for="beds">Beds</label>
      <input id="beds" v-model.number="form.beds" type="text" name="beds" />
      <div v-if="form.errors.beds">
        {{ form.errors.beds }}
      </div>
    </div>
    <div>
      <label for="bathrooms">Bathrooms</label>
      <input
        id="bathrooms"
        v-model.number="form.bathrooms"
        type="text"
        name="bathrooms"
      />
      <div v-if="form.errors.bathrooms">
        {{ form.errors.bathrooms }}
      </div>
    </div>
    <div>
      <label for="area">Area</label>
      <input id="area" v-model.number="form.area" type="text" name="area" />
      <div v-if="form.errors.area">
        {{ form.errors.area }}
      </div>
    </div>
    <div>
      <label for="city">City</label>
      <input id="city" v-model="form.city" type="text" name="city" />
      <div v-if="form.errors.city">
        {{ form.errors.city }}
      </div>
    </div>
    <div>
      <label for="street">Street</label>
      <input id="street" v-model="form.street" type="text" name="street" />
      <div v-if="form.errors.street">
        {{ form.errors.street }}
      </div>
    </div>
    <div>
      <label for="code">Post Code</label>
      <input
        id="code"
        v-model="form.postal_code"
        type="text"
        name="postal_code"
      />
      <div v-if="form.errors.postal_code">
        {{ form.errors.postal_code }}
      </div>
    </div>
    <div>
      <label for="st_number">Street N°</label>
      <input
        id="st_number"
        v-model="form.street_number"
        type="text"
        name="street_number"
      />
      <div v-if="form.errors.street_number">
        {{ form.errors.street_number }}
      </div>
    </div>
    <div>
      <label for="price">Price</label>
      <input
        id="price"
        v-model.number="form.price"
        type="text"
        name="price"
      />
      <div v-if="form.errors.price">
        {{ form.errors.price }}
      </div>
    </div>
    <div>
      <button type="submit">Save</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  listing: Object,
})

const form = useForm({
  beds: props.listing.beds,
  bathrooms: props.listing.bathrooms,
  area: props.listing.area,
  city: props.listing.city,
  street: props.listing.city,
  postal_code: props.listing.postal_code,
  street_number: props.listing.street_number,
  price: props.listing.price,
})

const update = () => form.put(route('listing.update', { listing: props.listing.id }))
</script>

<style scoped>
label {
  margin-right: 2em;
}

div {
  padding: 0.3em;
}
</style>
