<script setup>
import { category } from "@/store/category.js"
import { computed } from "vue";

category().fetchCategories()
const categories = computed(() => category().getCategories)
</script>

<template>
    <div class="col-span-2 bg-gray-800 text-white min-h-screen border-t">
        <ul>
            <li v-for="category in categories" :key="category.id">
                <router-link
                    :to="'/categories/' + category.id"
                    class="block p-3 hover:bg-gray-700 border-b"
                >
                    {{ category.name }}
                </router-link>
            </li>
        </ul>
    </div>
</template>
