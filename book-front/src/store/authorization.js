import { defineStore } from "pinia";
import axios from "axios";

export const authorization = defineStore("authorization", {
    actions: {
        auth(data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://localhost:9999/api/users/auth", data)
                    .then((response) => {
                        console.log("Token olindi!");
                        console.log(response);

                        localStorage.setItem("token", response.data.token);
                        resolve();
                    })
                    .catch((error) => {
                        console.log("Token olishda xatolik yuz berdi!");
                        console.error("Xatolik tafsiloti:", error.response?.data || error.message);
                        reject();
                    });
            });
        },
    },
});
