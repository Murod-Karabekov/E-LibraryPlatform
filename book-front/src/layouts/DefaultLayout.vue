<script setup>

import TheFooter from "@/components/TheFooter.vue";
import TheHeader from "@/components/TheHeader.vue";
import TheCategory from "@/components/TheCategory.vue";
</script>

<template>
    <TheHeader />

    <!-- main content -->
    <div class="grid grid-cols-12 gap-6">
        <!-- sidebar -->
        <div class="col-span-2">
            <TheCategory />
        </div>

        <!-- main content -->
        <div class="col-span-10 mt-5">
            <router-view />
        </div>
    </div>

    <TheFooter />
</template>

<style scoped>

</style>