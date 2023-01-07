<template>
  <p>
    {{ listing.street }} {{ listing.street_number }}, {{ listing.city }}
  </p>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>
