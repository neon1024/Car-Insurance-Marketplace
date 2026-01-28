<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3';

const form = ref({
    username: '',
    password: ''
})

// TODO
const handleLogin = () => {
    router.post("/login", {
        "username": form.value.username,
        "password": form.value.password
    });
}
</script>

<template>
    <div class="min-h-screen bg-slate-900 flex flex-col">
        <header class="py-6 text-center">
            <h1 class="text-3xl font-bold text-white">Login</h1>
        </header>

        <main class="flex-1 flex items-center justify-center">
            <form
                @submit.prevent="handleLogin"
                class="w-80 bg-slate-950 border-2 border-green-600 rounded-xl p-6 space-y-4"
            >
                <input
                    v-model="form.username"
                    type="text"
                    placeholder="Username"
                    class="w-full p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                />

                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="w-full p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                />

                <button
                    type="submit"
                    class="w-full py-3 rounded bg-green-600 text-black font-semibold hover:bg-green-500 transition"
                >
                    Login
                </button>
            </form>
        </main>
    </div>
</template>
