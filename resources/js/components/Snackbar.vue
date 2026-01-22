<script setup lang="ts">
import { watch, ref, onUnmounted, nextTick } from 'vue'

const props = defineProps<{
    visible: boolean
    text: string
    duration?: number
}>()

const emit = defineEmits<{
    (e: 'close'): void
}>()

const timeoutId = ref<number | null>(null)
const barKey = ref(0)

watch(
    () => props.visible,
    async (v) => {
        if (!v) {
            if (timeoutId.value) {
                clearTimeout(timeoutId.value)
                timeoutId.value = null
            }
            return
        }

        // restart animation
        barKey.value++
        await nextTick()

        timeoutId.value = window.setTimeout(() => {
            emit('close')
        }, props.duration ?? 5000)
    }
)

onUnmounted(() => {
    if (timeoutId.value) clearTimeout(timeoutId.value)
})
</script>

<template>
    <transition name="slide-up">
        <div v-show="visible" class="snackbar">
            {{ text }}

            <div
                :key="barKey"
                class="lifetime"
                :style="{ animationDuration: `${duration ?? 5000}ms` }"
            />
        </div>
    </transition>
</template>

<style scoped>
.snackbar {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    z-index: 50;
    background: #020617;
    color: #e5e7eb;
    border: 1px solid #1e293b;
    border-radius: 12px;
    padding: 16px 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    overflow: hidden;
}

.lifetime {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: #22c55e; /* green-500 */
    animation-name: shrink;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

@keyframes shrink {
    from { width: 100%; }
    to   { width: 0%; }
}

/* transition */
.slide-up-enter-active,
.slide-up-leave-active {
    transition: all 0.25s ease;
}
.slide-up-enter-from,
.slide-up-leave-to {
    opacity: 0;
    transform: translateY(16px);
}
</style>
