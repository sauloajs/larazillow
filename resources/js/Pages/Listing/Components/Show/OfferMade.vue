<template>
  <Box>
    <template #header>Offer Made</template>
    <Price :price="offer.amount" class="text-3xl" />

    <section
      class="flex flex-col justify-between mt-2 text-gray-500 md:flex-row"
    >
      <div>Made on</div>
      <div class="font-bold">{{ offerMadeOn }}</div>
    </section>
  </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { computed } from 'vue'
import moment from 'moment'
const props = defineProps({
  offer: Object,
})

const offerMadeOn = computed(
  () => moment(props.offer.created_at).format('DD/MM/YY HH:MM:SS'),
)
</script>
