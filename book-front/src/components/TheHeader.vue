<script setup>
import {useRouter} from "vue-router";
const router = useRouter();

function logout() {
    localStorage.removeItem("token");

    router.push("/login");
}
</script>

<template>
    <header class="bg-gray-800">
        <ul class="flex indent-10 text-white font-bold">
            <router-link to="/" class="p-3 cursor-pointer hover:text-gray-500">Bosh sahifa</router-link>
<!--            <li class="p-3 cursor-pointer hover:text-gray-500">Kitoblar</li>-->
<!--            <li class="p-3 cursor-pointer hover:text-gray-500">Bestsellerlar</li>-->
            <router-link to="/book/add" class="p-3 cursor-pointer hover:text-gray-500">Kitob qo'shish</router-link>
            <router-link to="/categories/set" class="p-3 cursor-pointer hover:text-gray-500">Kategoriyalar</router-link>
            <li class="p-3 cursor-pointer hover:text-gray-500">Shaxsiy kabinet</li>
<!--            <router-link to="/login" class="p-3 cursor-pointer hover:text-gray-500">Kirish</router-link>-->
            <li @click="logout" class="p-3 cursor-pointer hover:text-gray-500">Chiqish</li>
        </ul>
    </header>
</template>

<style scoped>

</style>