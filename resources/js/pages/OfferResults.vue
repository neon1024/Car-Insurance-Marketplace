<script setup lang="ts">
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

interface Installment {
    id: number
    amount: number
    dueDate: string
}

interface DirectCompensation {
    providerOfferCode: string
    premiumAmount: number
    commissionValue: number
    commissionPercent: number
}

interface Offer {
    offerId: number
    providerOfferCode: string
    premiumAmount: number
    premiumAmountNet: number
    currency: string
    startDate: string
    endDate: string
    referenceRate: number
    bonusMalusClass: string
    commissionValue: number
    commissionPercent: number
    directCompensation: DirectCompensation
    installments: Installment[]
    greenCardExclusions: string
    notes: string | null
    offerExpiryDate: string
    pid: string
}

interface InsurerOffers {
    insurer: string
    offers: Offer[]
}

/**
 * Props from controller
 */
const props = defineProps<{
    offers: InsurerOffers[]
}>()

/**
 * Inertia validation errors
 */
const page = usePage()

const errors = computed<Record<string, string[]>>(() => {
    return (page.props.errors ?? {}) as Record<string, string[]>
})
</script>

<template>
    <div>
        <h1>Oferte RCA</h1>

        <!-- Validation errors -->
        <div v-if="Object.keys(errors).length" class="errors">
            <p v-for="(msgs, field) in errors" :key="field">
                <strong>{{ field }}:</strong>
                {{ Array.isArray(msgs) ? msgs.join(', ') : msgs }}
            </p>
        </div>

        <!-- Offers grouped by insurer -->
        <div v-if="props.offers.length">
            <div
                v-for="insurerGroup in props.offers"
                :key="insurerGroup.insurer"
                class="insurer-block"
            >
                <h2>{{ insurerGroup.insurer }}</h2>

                <ul v-if="insurerGroup.offers.length">
                    <li
                        v-for="offer in insurerGroup.offers"
                        :key="offer.offerId"
                        class="offer-item"
                    >
                        <strong>Premium:</strong>
                        {{ offer.premiumAmount }} {{ offer.currency }}
                        |
                        <strong>Start:</strong> {{ offer.startDate }}
                        |
                        <strong>End:</strong> {{ offer.endDate }}
                    </li>
                </ul>

                <p v-else>No offers from this insurer.</p>
            </div>
        </div>

        <p v-else>No offers available.</p>
    </div>
</template>

<style scoped>
.errors {
    background: #ffe5e5;
    color: #a00;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #a00;
    border-radius: 5px;
}

.insurer-block {
    margin-bottom: 2rem;
}

.offer-item {
    padding: 0.5rem 0;
}
</style>
