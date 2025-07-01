<script setup>
import { category } from "@/store/category.js"
import { computed, reactive, ref } from "vue"
import InputForm from "@/components/html/InputForm.vue"

const categoryStore = category()

const mode = ref('add')
const newCategory = reactive({
    name: ''
})

categoryStore.fetchCategories()

const categories = computed(() => categoryStore.getCategories)
function saveCategoryFunc() {
    if (!newCategory.name.trim()) return

    categoryStore.createCategory({ name: newCategory.name })
        .then(() => {
            newCategory.name = ''
            categoryStore.fetchCategories()
        })
        .catch((err) => {
            console.error("Yaratishda xatolik:", err)
        })
}

const updateCategoryFunc = (category) => {
    if (!category.name.trim()) {
        alert("Kategoriya nomi bo‘sh bo‘lmasligi kerak!");
        return;
    }
    categoryStore.updateCategory(category)
        .then(() => {
            alert("Kategoriya muvaffaqiyatli yangilandi!");
        })
        .catch(() => {
            alert("Xatolik yuz berdi!");
        });
}

function deleteCategoryFunc(id) {
    if (confirm("Haqiqatan ham o‘chirmoqchimisiz?")) {
        categoryStore.deleteCategory(id)
            .then(() => {
                categoryStore.fetchCategories()
            })
            .catch((err) => {
                console.error("O‘chirishda xatolik:", err)
            })
    }
}

</script>


<template>
    <div class="p-6">
        <!-- Radio Buttonlar -->
        <div class="flex gap-4 mb-6">
            <label>
                <input type="radio" value="add" v-model="mode" />
                Qo'shish
            </label>
            <label>
                <input type="radio" value="edit" v-model="mode" />
                O'zgartirish
            </label>
            <label>
                <input type="radio" value="delete" v-model="mode" />
                O'chirish
            </label>
        </div>

        <!-- Qo'shish -->
        <div v-if="mode === 'add'" class="flex justify-left mt-6">
            <div class="w-full max-w-md bg-gray-800 p-6 rounded-xl shadow-md space-y-4">
                <InputForm
                    v-model="newCategory.name"
                    input-name="categoryName"
                    input-placeholder="Yangi kategoriya nomi"
                    input-type="text"
                    input-id="categoryName"
                    label-name="Kategoriya nomi"
                />
                <button
                    @click="saveCategoryFunc"
                    class="w-full bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold py-2 px-4 rounded-lg"
                >
                    Qo'shish
                </button>
            </div>
        </div>


        <!-- O'zgartirish -->
        <div v-if="mode === 'edit'" class="space-y-4">
            <div v-for="category in categories" :key="category.id" class="flex gap-2 items-center">
                <input v-model="category.name" class="border p-2 bg-green-100 rounded w-1/3" />
                <button @click="updateCategoryFunc(category)" class="bg-green-600 text-white px-3 py-2 rounded">Saqlash</button>
            </div>
        </div>

        <!-- O'chirish -->
        <div v-if="mode === 'delete'" class="space-y-4">
            <div v-for="category in categories" :key="category.id" class="flex gap-4 items-center">
                <input type="text" :value="category.name" disabled class="border p-2 rounded w-1/3 bg-gray-100" />
                <button @click="deleteCategoryFunc(category.id)" class="bg-red-600 text-white px-4 py-2 rounded">O'chirish</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
input[type="radio"] {
    margin-right: 6px;
}
</style>
