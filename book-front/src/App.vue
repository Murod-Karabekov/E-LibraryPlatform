<script setup>

import TheHeader from "@/components/TheHeader.vue";
import TheCategory from "@/components/TheCategory.vue";
import TheBook from "@/components/TheBook.vue";
import ThePagination from "@/components/ThePagination.vue";
import TheFooter from "@/components/TheFooter.vue";
import HomePage from "@/pages/HomePage.vue";
import BookContent from "@/pages/BookContent.vue";

</script>

<template>
    <component :is="$route.meta.layout" />
</template>

<style scoped>

</style>
