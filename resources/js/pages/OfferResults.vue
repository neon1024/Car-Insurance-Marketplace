<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';

interface Installment {
    id: number;
    amount: number;
    dueDate: string;
}

interface DirectCompensation {
    providerOfferCode: string;
    premiumAmount: number;
    commissionValue: number;
    commissionPercent: number;
}

interface Offer {
    offerId: number;
    providerOfferCode: string;
    premiumAmount: number;
    premiumAmountNet: number;
    currency: string;
    startDate: string;
    endDate: string;
    referenceRate: number;
    bonusMalusClass: string;
    commissionValue: number;
    commissionPercent: number;
    directCompensation: DirectCompensation;
    installments: Installment[];
    greenCardExclusions: string;
    notes: string | null;
    offerExpiryDate: string;
    pid: string;
}

// Props from Inertia
const { insurer, offers } = defineProps<{
    insurer: string;
    offers: Offer[];
    errors: Record<string, string[]>;
}>();
</script>

<template>
    <div>
        <h1>Offers from {{ insurer }}</h1>

        <!-- Display Laravel validation errors -->
        <div v-if="Object.keys(errors).length" class="errors">
            <p v-for="(msgs, field) in errors" :key="field">
                <strong>{{ field }}:</strong> {{ msgs.join(', ') }}
            </p>
        </div>

        <ul v-if="offers.length">
            <li v-for="offer in offers" :key="offer.offerId">
                <strong>Premium:</strong> {{ offer.premiumAmount }} {{ offer.currency }} |
                <strong>Start:</strong> {{ offer.startDate }} |
                <strong>End:</strong> {{ offer.endDate }}
            </li>
        </ul>

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
</style>
