<script setup>
import InputForm from "@/components/html/InputForm.vue"
import { ref } from "vue"
import { user } from "@/store/user.js"
import { useRouter } from 'vue-router'

const userStore = user()
const router = useRouter()

const email = ref("")
const password = ref("")
const age = ref("")
const gender = ref("")
const phone = ref("")

function formatPhoneNumber(value) {
    let digits = value.replace(/\D/g, "").slice(0, 9)
    if (digits.length <= 2) return "+(" + digits
    if (digits.length <= 5) return `+(${digits.slice(0, 2)}) ${digits.slice(2)}`
    if (digits.length <= 7)
        return `+(${digits.slice(0, 2)}) ${digits.slice(2, 5)}-${digits.slice(5)}`
    return `+(${digits.slice(0, 2)}) ${digits.slice(2, 5)}-${digits.slice(5, 7)}-${digits.slice(7)}`
}

function handlePhoneInput(event) {
    phone.value = formatPhoneNumber(event.target.value)
}

async function registerUser() {
    if (!email.value || !password.value || !age.value || !gender.value || !phone.value) {
        alert("Barcha maydonlar to‘ldirilishi shart!")
        return
    }

    const parsedAge = parseInt(age.value)
    if (isNaN(parsedAge)) {
        alert("Yoshingiz raqam bo‘lishi kerak!")
        return
    }

    if (parsedAge < 16 || parsedAge > 100) {
        alert("Yosh 16 va 100 orasida bo‘lishi kerak.")
        return
    }

    const payload = {
        email: email.value,
        password: password.value,
        age: parsedAge,
        gender: gender.value,
        phone: phone.value
    }

    try {
        await userStore.registerUser(payload)

        await userStore.loginUser({
            email: payload.email,
            password: payload.password
        })

        console.log("Foydalanuvchi muvaffaqiyatli ro‘yxatdan o‘tdi!")
        router.push('/')
    } catch (error) {
        const detail = error.response?.data?.detail || ""

        if (detail === "Ushbu email tizimda mavjud!") {
            alert("Siz allaqachon ro‘yxatdan o‘tgansiz!")
        } else {
            console.log("Xatolik yuz berdi: " + (detail || "Tizim xatosi"))
        }
    }

}
</script>

<template>
    <section class="bg-gray-900">
        <div class="flex items-center justify-center min-h-screen px-1 py-8">
            <div class="w-full max-w-md bg-gray-800 border border-gray-700 rounded-lg p-6 text-white space-y-6">
                <h2 class="text-2xl font-bold text-center">Ro'yxatdan o'tish</h2>
                <div class="mb-7">
                    <InputForm
                        v-model="email"
                        label-name="Email"
                        input-name="email"
                        input-id="email"
                        input-type="email"
                        input-placeholder="user@example.com"
                    />
                </div>

                <div class="mb-7">
                    <InputForm
                        v-model="password"
                        label-name="Parol"
                        input-name="password"
                        input-id="password"
                        input-type="password"
                        input-placeholder="********"
                    />
                </div>

                <div class="mb-7">
                    <InputForm
                        v-model="age"
                        label-name="Yoshingiz"
                        input-name="age"
                        input-id="age"
                        input-type="number"
                        input-placeholder="16"
                    />
                </div>

                <div class="mb-7">
                    <label class="block">Jinsingiz</label>
                    <div class="flex gap-4 mb-4">
                        <label><input type="radio" value="erkak" v-model="gender" class="mr-1" />Erkak</label>
                        <label><input type="radio" value="ayol"  v-model="gender" class="mr-1" />Ayol</label>
                    </div>
                </div>

                <div class="mb-7">
                    <label for="phone">Telefon raqam</label>
                    <input id="phone" name="phone" type="text" :value="phone" @input="handlePhoneInput"
                           placeholder="+(99) 111-11-11"
                           class="border rounded p-2 w-full bg-gray-700 border-gray-600 text-white" />
                </div>

                <button
                    type="button"
                    @click="registerUser"
                    :disabled="isFormInvalid"
                    :class="[
                        'w-full font-semibold py-2 px-4 rounded-lg transition-colors',
                         isFormInvalid
                         ? 'bg-blue-400 cursor-not-allowed'
                         : 'bg-blue-600 hover:bg-blue-700'
                    ]"
                >
                    Ro'yxatdan o'tish
                </button>


            </div>
        </div>
    </section>
</template>

<style scoped>

</style>