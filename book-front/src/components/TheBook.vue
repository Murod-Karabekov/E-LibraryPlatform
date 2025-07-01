<script setup>
import { book } from "@/store/book.js"
import { computed, watch } from "vue"
import {useRoute} from "vue-router";

const route = useRoute()

watch(
    () => route.params.id,
    (id) => {
        if (id) {
            book().fetchBooks(id)
        } else {
            book().fetchBooks()
        }
    },
    { immediate: true }
)
const books = computed(() => book().getBooks)

</script>


<template>
    <div v-for="book in books" class="col-span-3 bg-gray-100 border rounded shadow-lg">
        <img :src="'http://localhost:9999' + book.image.contentUrl" alt="#" class="w-full h-auto rounded-t" />
        <div>
            <h5 class="font-bold text-2xl px-2">{{ book.name }}</h5>
            <p class="px-2 pt-2">{{ book.description }}</p>
            <router-link
                :to="'/book-content/' + book.id"
                href="#"
                class="bg-blue-500 text-white py-1 px-3 rounded float-right mr-3 mb-3"
            >
                O'qish
            </router-link>
        </div>
    </div>
</template>


<style scoped>

</style>