<template>
  <div class="flex flex-col-reverse gap-4 md:grid md:grid-cols-12">
    <Box class="flex items-center w-full col-span-12 md:col-span-7">
      <div
        v-if="listing.images.length"
        class="grid grid-cols-2 gap-1"
      >
        <img
          v-for="image in listing.images"
          :key="image.id"
          :src="image.src"
          :alt="listing.street"
        />
      </div>
      <div v-else class="w-full font-medium text-center text-grey">
        No Images
      </div>
    </Box>
    <div class="flex flex-col gap-4 md:col-span-5">
      <Box>
        <template #header>Basic Info</template>
        <Price :price="listing.price" />
        <ListingSpace :listing="listing" />
        <ListingAddress :listing="listing" />
      </Box>
      <Box>
        <template #header>Monthly Payment</template>
        <div>
          <label class="label">Interest rate ({{ interestRate }}%)</label>
          <input
            v-model.number="interestRate"
            type="range"
            min="0.1"
            max="30"
            step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <label class="label">Duration ({{ duration }} years)</label>
          <input
            v-model.number="duration"
            type="range"
            min="3"
            max="35"
            step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <div class="mt-2 text-gray-600 dark:text-gray-300">
            <div class="text-gray-400">Your monthly payment</div>
            <Price :price="monthlyPayment" class="text-3xl" />
          </div>

          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total paid</div>
              <div>
                <Price
                  :price="totalPaid"
                  class="font-medium"
                />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Principal paid</div>
              <div>
                <Price
                  :price="listing.price"
                  class="font-medium"
                />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Interest paid</div>
              <div>
                <Price
                  :price="totalInterest"
                  class="font-medium"
                />
              </div>
            </div>
          </div>
        </div>
      </Box>
      <MakeOffer v-if="user" :listing-id="listing.id" :price="listing.price" />
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import MakeOffer from './Components/Show/MakeOffer.vue'
import { usePage } from '@inertiajs/inertia-vue3'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
  listing: Object,
})

const page = usePage()
const user = computed(
  () => page.props.value.user,
)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration)

</script>
