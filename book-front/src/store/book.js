import { defineStore } from "pinia";
import axios from "@/plugins/axios.js";

export const book = defineStore("book", {
    state() {
        return {
            books: [],
            book: []
        };
    },
    actions: {
        fetchBooks(categoryId = null) {
            return new Promise((resolve, reject) => {
                let url = "http://localhost:9999/api/books";

                if (categoryId) {
                    url += `?category.id=${categoryId}`;
                }

                axios.get(url)
                    .then((response) => {
                        console.log("Kitoblar olindi:", response.data);
                        this.books = response.data["member"] || [];
                        resolve();
                    })
                    .catch((error) => {
                        console.error("Kitoblarni olishda xatolik:", error.response?.data || error.message);
                        reject(error);
                    });
            });
        },
        async fetchBook(bookId) {
            try {
                const response = await axios.get(`http://localhost:9999/api/books/${bookId}`);
                console.log("Kitob olindi:", response.data);

                this.book = {
                    id: response.data.id,
                    name: response.data.name,
                    description: response.data.description,
                    text: response.data.text
                };
            } catch (error) {
                console.log('Kitob olishda xatolik yuz berdi');
                throw error;
            }
        },
        createBook(data) {
            return new Promise((resolve, reject) => {
                axios.post(`http://localhost:9999/api/books`, data)
                    .then((response) => {
                        console.log("Kitob joylandi")
                        console.log(response)

                        resolve()
                    })
                    .catch(() => {
                        console.log("Kitob joylashda xatolik yuz berdi")

                        reject()
                    })
            })
        }

    },
    getters: {
        getBooks() {
            return this.books;
        },
        getBook() {
            return this.book;
        }
    }
});
