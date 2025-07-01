<script setup>

import InputForm from "@/components/html/InputForm.vue";
import {reactive, ref} from "vue";
import { authorization } from "@/store/authorization.js";
import { useRouter } from "vue-router";

let data = reactive({email: '',password: ''})
let isError = ref(false)
let router = useRouter()

function login () {
    console.log('Kirishga bosdiz')
    authorization().auth(data)
        .then(() => {
            isError.value = false
            router.push('/')
        })
        .catch(() => {
            isError.value = true
        })
}
</script>

<template>
    <section class="bg-gray-900">
        <div class="flex items-center justify-center min-h-screen px-1 py-8">
            <div class="w-1/3 bg-gray-800 border-gray-700 rounded-lg">
                <div v-if="isError" class="text-2xl text-red-600 font-bold text-center">Email yoki parol noto'g'ri</div>

                <div class="p-6 space-y-4">
                    <h1 class="text-white font-bold text-xl">Tizimga kirish</h1>
                        <form>
                            <div class="mb-5">
                                <inputForm
                                    input-name="email"
                                    label-name="Email"
                                    input-id="email"
                                    v-model="data.email"
                                />
                            </div>

                            <div class="mb-7">
                                <inputForm
                                    input-name="password"
                                    label-name="Password"
                                    input-id="password"
                                    input-type="password"
                                    input-placeholder="***********"
                                    v-model="data.password"
                                    :showToggle="true"
                                />
                            </div>

                            <button
                                @click="login"
                                type="button"
                                class="text-white font-bold bg-blue-800 w-full py-2 rounded hover:bg-blue-600 focus:ring-2"
                            >

                            Kirish
                            </button>

                            <div class="text-white flex justify-center font-bold w-full py-2 rounded focus:ring-2">
                                YOKI
                            </div>

                            <router-link
                                to="/registration"
                                class="text-white font-bold bg-blue-800 w-full mt-4 py-2 rounded hover:bg-blue-600 focus:ring-2 text-center block"
                            >
                                Yangi akkount yaratish
                            </router-link>

                        </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>