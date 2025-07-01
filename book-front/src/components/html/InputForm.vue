<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    labelName: {
        type: String,
        default: 'Email'
    },
    inputType: {
        type: String,
        default: 'email'
    },
    inputName: {
        type: String,
        default: ''
    },
    inputId: {
        type: String,
        default: ''
    },
    inputPlaceholder: {
        type: String,
        default: 'name@company.com'
    },
    modelValue: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue'])

const isPasswordVisible = ref(false)

const currentInputType = computed(() => {
    if (props.inputType !== 'password') return props.inputType
    return isPasswordVisible.value ? 'text' : 'password'
})

function toggleVisibility() {
    isPasswordVisible.value = !isPasswordVisible.value
}
</script>

<template>
    <label :for="inputId" class="text-white">{{ labelName }}</label>
    <div class="relative">
        <input
            class="border rounded p-2 w-full bg-gray-700 border-gray-600 text-white pr-10"
            :name="inputName"
            :type="currentInputType"
            :id="inputId"
            :placeholder="inputPlaceholder"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />

        <button
            v-if="inputType === 'password'"
            type="button"
            class="absolute inset-y-0 right-0 px-3 text-white"
            @click="toggleVisibility"
        >
            <span v-if="isPasswordVisible">🙈</span>
            <span v-else>👁️</span>
        </button>
    </div>
</template>
