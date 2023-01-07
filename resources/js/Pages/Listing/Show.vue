<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box class="col-span-12 md:col-span-7 flex items-center w-full">
      <div class="w-full text-center font-medium text-grey">
        No Images
      </div>
    </Box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>Basic Info</template>
        <Price :price="listing.price" />
        <ListingSpace :listing="listing" />
        <ListingAddress :listing="listing" />
      </Box>
      <Box>
        <template #header>Offer</template>
        Make an offer
      </Box>
    </div>
  </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";

defineProps({
  listing: Object,
});
</script>
