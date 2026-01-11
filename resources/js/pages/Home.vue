<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types/inertia';

const page = usePage<PageProps>();

const token = computed(() => page.props.session.token);
const refresh_token = computed(() => page.props.session.refresh_token);
const expires_at = computed(() => page.props.session.token_expires_at);

</script>

<template>
    <body>
        <header>
            <Link href="/login">Login</Link>
        </header>
        <main>
            <Link href="/offers">Car Insurance Offers</Link>
        </main>
        <footer>
            <div v-if="token">{{ token }}</div>
            <div v-if="refresh_token">{{ refresh_token }}</div>
            <div v-if="expires_at">{{ expires_at }}</div>
        </footer>
    </body>
</template>

<style scoped></style>
