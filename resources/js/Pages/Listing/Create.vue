<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label" for="beds">Beds</label>
        <input id="beds" v-model.number="form.beds" type="text" name="beds" class="input" />
        <div v-if="form.errors.beds" class="input-error">
          {{ form.errors.beds }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label" for="bathrooms">Bathrooms</label>
        <input
          id="bathrooms"
          v-model.number="form.bathrooms"
          type="text"
          name="bathrooms"
          class="input"
        />
        <div v-if="form.errors.bathrooms" class="input-error">
          {{ form.errors.bathrooms }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label" for="area">Area</label>
        <input id="area" v-model.number="form.area" type="text" name="area" class="input" />
        <div v-if="form.errors.area" class="input-error">
          {{ form.errors.area }}
        </div>
      </div>

      <div class="col-span-4">
        <label class="label" for="city">City</label>
        <input id="city" v-model="form.city" type="text" name="city" class="input" />
        <div v-if="form.errors.city" class="input-error">
          {{ form.errors.city }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label" for="code">Post Code</label>
        <input
          id="code"
          v-model="form.postal_code"
          type="text"
          name="postal_code"
          class="input"
        />
        <div v-if="form.errors.postal_code" class="input-error">
          {{ form.errors.postal_code }}
        </div>
      </div>
      <div class="col-span-4">
        <label class="label" for="street">Street</label>
        <input id="street" v-model="form.street" type="text" name="street" class="input" />
        <div v-if="form.errors.street" class="input-error">
          {{ form.errors.street }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label" for="st_number">Street N°</label>
        <input
          id="st_number"
          v-model="form.street_number"
          type="text"
          name="street_number"
          class="input"
        />
        <div v-if="form.errors.street_number" class="input-error">
          {{ form.errors.street_number }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="label" for="price">Price</label>
        <input
          id="price"
          v-model.number="form.price"
          type="text"
          name="price"
          class="input"
        />
        <div v-if="form.errors.price" class="input-error">
          {{ form.errors.price }}
        </div>
      </div>
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Save</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
  beds: 0,
  bathrooms: 0,
  area: 0,
  city: null,
  street: null,
  postal_code: null,
  street_number: null,
  price: 0,
})

const create = () => form.post('/listing')
</script>

<style scoped>
label {
  margin-right: 2em;
}

div {
  padding: 0.3em;
}
</style>
