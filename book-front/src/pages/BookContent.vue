<script setup>

import {useRoute} from "vue-router";
import {book} from "@/store/book.js";
import {computed} from "vue";

const route = useRoute()

book().fetchBook(route.params.bookId)

const fetchedBook = computed(() => book().getBook)

</script>

<template>
    <h2 class="text-2xl font-extrabold mb-5">{{ fetchedBook.name }}</h2>

    <p class="py-3 text-justify">{{ fetchedBook.text }}</p>
</template>

<style scoped>

</style>