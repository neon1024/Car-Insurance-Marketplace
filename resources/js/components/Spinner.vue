<script setup lang="ts">
defineProps<{
    visible: boolean
}>();
</script>

<template>
    <div v-if="visible" class="overlay">
        <div class="spinner"></div>
    </div>
</template>

<style scoped>
.overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
}

.spinner {
    width: 70px;
    height: 70px;
    border: 6px solid rgba(71, 85, 105, 0.4);
    border-top: 6px solid #22c55e; /* green-500 */
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
