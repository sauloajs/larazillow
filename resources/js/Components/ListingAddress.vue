<template>
  <p>
    {{ listing.street }} {{ listing.street_number }}, {{ listing.city }}, for
    ${{ listing.price }}
  </p>
</template>

<script setup>
defineProps({
  listing: Object,
});
</script>
