<template>
  <Box>
    <template #header>
      Offer #{{ offer.id }}
      <span
        v-if="offer.accepted_at"
        class="p-1 ml-2 text-green-900 uppercase bg-green-200 rounded-md dark:bg-green-900 dark:text-green-200"
      >
        accepted
      </span>
    </template>

    <section class="flex items-center justify-between">
      <div>
        <Price :price="offer.amount" class="text-xl" />
        <div class="text-gray-500">
          Difference <Price :price="difference" class="text-xl" />
        </div>
      </div>
      <div class="text-sm text-gray-500">
        Made by {{ offer.bidder.name }}
      </div>
      <div class="text-sm text-gray-500">
        Made on {{ madeOn }}
      </div>
      <div>
        <Link
          v-if="!isSold"
          :href="route('realtor.offer.accept', { offer: offer.id })"
          as="button"
          method="put"
          class="text-xs font-medium btn btn-outline"
        >
          Accept
        </Link>
      </div>
    </section>
  </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'
import moment from 'moment'
import { computed } from 'vue'

const props = defineProps({
  offer: Object,
  listingPrice: Number,
  isSold: Boolean,
})

const difference = computed(
  () => props.offer.amount - props.listingPrice,
)

const madeOn = computed(
  () => moment(props.offer.created_at).format('DD/MM/YY HH:MM:SS'),
)
</script>
