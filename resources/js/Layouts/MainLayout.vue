<template>
  <Link :href="route('listing.index')">Listings</Link> |
  <Link :href="route('listing.create')">New Listing</Link>
  <div v-if="flashSuccess" class="success">
    {{ flashSuccess }}
  </div>
  <slot />
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import {computed} from 'vue'

const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)

</script>

<style scoped>
.success {
  color: #fff;
  background-color: rgb(101, 188, 101);
}
</style>
