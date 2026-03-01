<script setup lang="ts">
import { ref, defineProps, defineEmits, watch } from 'vue';

const props = defineProps<{
    visible: boolean,
    userExists: boolean
}>();

const emit = defineEmits<{
    (e: 'submit', password: string): void,
    (e: 'cancel'): void
}>();

const password = ref('');

watch(() => props.visible, (newVal) => {
    if(newVal) password.value = '';
});

const submitPassword = () => {
    emit('submit', password.value);
};

const cancel = () => {
    emit('cancel');
};
</script>

<template>
    <div v-if="visible" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-slate-900 rounded-xl p-6 w-96 text-white space-y-4">
            <h2 class="text-lg font-bold">{{ userExists ? 'Login' : 'Creează cont' }}</h2>
            <p>{{ userExists ? 'Introdu parola pentru a continua' : 'Alege o parolă pentru contul tău' }}</p>
            <input v-model="password" type="password" placeholder="Parola" class="w-full rounded-xl p-3 bg-slate-800 border border-slate-700 outline-none" />
            <div class="flex justify-end gap-3">
                <button @click="cancel" class="px-4 py-2 bg-red-600 rounded-xl">Renunță</button>
                <button @click="submitPassword" class="px-4 py-2 bg-green-600 rounded-xl">{{ userExists ? 'Login' : 'Creează' }}</button>
            </div>
        </div>
    </div>
</template>
