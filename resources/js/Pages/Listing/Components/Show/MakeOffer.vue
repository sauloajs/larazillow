<template>
  <Box>
    <template #header>Make an Offer</template>
    <div>
      <form
        @submit.prevent="makeOffer"
      >
        <input
          v-model.number="form.amount"
          type="text"
          class="input"
        />
        <input
          v-model.number="form.amount"
          type="range"
          :min="min"
          :max="max"
          step="10000"
          class="w-full h-4 mt-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />

        <button
          type="submit"
          class="w-full mt-2 text-sm btn-outline"
        >
          Make an Offer
        </button>

        {{ form.errors.amount }}
      </form>
    </div>
    <div class="flex justify-between mt-2 text-gray-500">
      <div>Difference</div>
      <div>
        <Price :price="difference" />
      </div>
    </div>
  </Box>
</template>


<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
  listingId: Number,
  price: Number,
})
const form = useForm({
  amount: props.price,
})

const difference = computed(() => form.amount - props.price)
const min = computed(() => Math.round(props.price / 2))
const max = computed(() => Math.round(props.price * 2))

const makeOffer = () => form.post(
  route('listing.offer.store',
    {
      listing: props.listingId,
    },
  ),
  {
    preserveScroll: true,
    preserveState: true,
  },
)
</script>
