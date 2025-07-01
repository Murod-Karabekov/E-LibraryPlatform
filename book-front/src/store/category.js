import { defineStore } from "pinia"
import axios from "@/plugins/axios.js"

export const category = defineStore("category", {
    actions: {
        fetchCategories() {
            return new Promise((resolve, reject) => {
                axios.get('http://localhost:9999/api/categories')
                    .then((response) => {
                        console.log('Kategoriyalar olindi')
                        console.log(response)
                        this.categories = response.data['member']

                        resolve()
                    })
                    .catch(() => {
                        console.log("Kategoriyalar olishda xatolik yuz berdi")

                        reject()
                    })
            })
        },
        createCategory(data) {
            return new Promise((resolve, reject) => {
                axios.post('http://localhost:9999/api/categories', data)
                    .then((response) => {
                        console.log("✅ Kategoriya qo‘shildi:", response.data)
                        resolve(response.data)
                    })
                    .catch((error) => {
                        console.error("❌ Xatolik:", error)
                        reject(error)
                    })
            })
        },
        updateCategory(data) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`http://localhost:9999/api/categories/${data.id}`, data)
                    .then((response) => {
                        console.log("✅ Kategoriya yangilandi!", response.data)
                        resolve(response.data)
                    })
                    .catch((error) => {
                        console.error("❌ Kategoriya yangilashda xatolik", error)
                        reject(error)
                    })
            })
        },
        deleteCategory(id) {
            return new Promise((resolve, reject) => {
                axios.delete(`http://localhost:9999/api/categories/${id}`)
                    .then((response) => {
                        console.log("✅ Kategoriya o‘chirildi!", response.data)
                        resolve(response.data)
                    })
                    .catch((error) => {
                        console.error("❌ Kategoriya o‘chirishda xatolik", error)
                        reject(error)
                    })
            })
        }
    },
    state() {
        return {
            categories: [],
            category: {}
        }
    },
    getters: {
        getCategories() {
            return this.categories
        },
        getcategory() {
            return this.category
        }
    }
})