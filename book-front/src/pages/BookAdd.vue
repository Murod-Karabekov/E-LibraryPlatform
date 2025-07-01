<script setup>
import { category } from "@/store/category.js"
import InputForm from "@/components/html/InputForm.vue";
import { computed, reactive, ref } from "vue";
import {useRouter} from "vue-router";
import {mediaObject} from "@/store/MediaObject.js";
import {book} from "@/store/book.js";

category().fetchCategories()

const categories = computed(() => category().getCategories)

const router = useRouter()

let image = ref('')

function selectImage(event) {
    console.log('Rasm tanlandi')
    image = new FormData()
    image.append('file', event.target.files[0])
}

let newBook = reactive({
    name: '',
    description: '',
    text: '',
    category: ''
})

function saveBook() {
    mediaObject().createImage(image)
        .then(() => {
            newBook.image = mediaObject().getImage

            book().createBook(newBook)
                .then(() => {
                    router.push('/')
                })
        })
}

</script>

<template>
    <div class="grid grid-cols-12">
        <div class="col-span-12 text-2xl font-bold text-gray-600">
            Kitob qo'shing
        </div>

        <div class="col-span-8">
            <inputForm
                v-model="newBook.name"
                input-name="bookName"
                input-placeholder="Kitob nomini kiriting"
                input-type="text"
                input-id="bookName"
                label-name="bookName"
            />
        </div>

        <div class="col-span-8">
            <inputForm
                v-model="newBook.description"
                input-name="bookDescription"
                input-placeholder="Kitob tavsifini kiriting"
                input-type="text"
                input-id="bookDescription"
                label-name="bookDescription"
            />
        </div>

        <div class="col-span-8">
            <textarea
                v-model="newBook.text"
                rows="5"
                class="border rounded border-gray-700 bg-gray-700 text-white w-full mt-5 p-2"
                placeholder="Kitob matnini kiriting"
            />
        </div>

        <div class="col-span-8">
            <select v-model="newBook.category" class="border w-full rounded border-gray-600 bg-gray-700 text-white  mt-4 p-2.5">
                <option disabled value="">Kategoriyani tanlang</option>
                <option v-for="category of categories" :value="category['@id']">{{ category.name }}</option>
            </select>
        </div>

        <div class="col-span-8">
            <input
                class="border rounded border-gray-600 bg-gray-700 text-white w-full mt-4 p-2.5"
                placeholder="Kitob rasmini tanlang"
                type="file"
                @change="selectImage($event)"
            />
        </div>

        <div class="col-span-8">
            <button
                @click="saveBook"
                type="button"
                class="bg-blue-800 w-full mt-5 py-2 rounded text-white font-bold hover:bg-blue-600"
            >
                Saqlash
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>