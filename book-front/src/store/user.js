import { defineStore } from "pinia"
import axios from "@/plugins/axios"

export const user = defineStore("user", {
    state: () => ({
        userInfo: null
    }),
    actions: {
        async registerUser(data) {
            try {
                const response = await axios.post("http://localhost:9999/api/users/my", data)
                console.log("Ro'yxatdan o'tdi:", response.data)
                this.userInfo = response.data
                return response.data
            } catch (error) {
                console.error("Ro'yxatdan o'tishda xatolik:", error.response?.data || error.message)
                throw error
            }
        },
        async loginUser(credentials) {
            try {
                const response = await axios.post("http://localhost:9999/api/users/auth", credentials)
                const token = response.data.token

                if (token) {
                    localStorage.setItem("token", token)
                    this.userInfo = response.data.user
                    console.log("Login bo‘ldi:", response.data)
                }

                return response.data
            } catch (error) {
                console.error("Login xatosi:", error.response?.data || error.message)
                throw error
            }
        }
    },
    getters: {
        getUserInfo() {
            return this.userInfo
        }
    }
})
