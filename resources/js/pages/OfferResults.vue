<script setup lang="ts">
import { computed, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types/inertia';

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
    directCompensation: DirectCompensation | null
    installments: Installment[]
    greenCardExclusions: string
    notes: string | null
    offerExpiryDate: string
}

interface InsurerOffers {
    insurer: string,
    offers: Offer[]
}

interface OfferResultsProps extends PageProps {
    offers: InsurerOffers[]
    errors?: string
}

const page = usePage<OfferResultsProps>();

const offers = computed(() => page.props.offers ?? []);

const insurers = {
    "allianz": "Allianz",
    "asirom": "Asirom",
    "axeria": "Axeria",
    "generali": "Generali",
    "groupama": "Groupama",
    "hellas_autonom": "Hellas Autonom",
    "hellas_nextins": "Hellas Nextins",
    "omniasig": "Omniasig",
    "grawe": "Grawe",
    "eazy_insure": "Easy Insure"
};

function goBack() {
    router.get("/offers");
}

</script>

<template>
    <div
        class="min-h-screen bg-slate-900 bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))]
           from-slate-800 via-slate-900 to-slate-950 text-slate-200"
    >
        <header class="py-12 text-center">
            <button
                @click="goBack"
                class="fixed absolute top-10 left-10 z-50 rounded-2xl bg-green-500 px-8 py-4 font-black text-slate-950
         hover:bg-green-400 transition shadow-[0_0_30px_rgba(34,197,94,0.35)]"
            >
                ← Înapoi
            </button>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                Oferte <span class="text-green-500">RCA</span>
            </h1>
            <p class="mt-3 text-slate-400 font-medium">
                Am găsit {{ offers.length }} oferte disponibile
            </p>
        </header>

        <main class="max-w-5xl mx-auto px-6 pb-24 space-y-8">
            <div
                v-for="offer in offers"
                :key="offer.offers.at(0)!.offerId"
                class="relative overflow-hidden rounded-3xl bg-slate-900/50 backdrop-blur-xl
               border border-slate-800 shadow-2xl p-8 transition hover:scale-[1.01]"
            >
                <!-- top glow line -->
                <div class="absolute top-0 left-0 right-0 h-[1px]
                    bg-gradient-to-r from-transparent via-green-500/50 to-transparent" />

                <!-- header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-green-400 text-3xl">
                            {{insurers[offer.insurer as keyof typeof insurers]}}
                        </h1>
                        <h2 class="text-xl font-bold text-white">
                            {{ offer.offers.at(0)!.providerOfferCode }}
                        </h2>
                        <p class="text-sm text-slate-400">
                            Bonus-Malus: <span class="text-green-400">{{ offer.offers.at(0)!.bonusMalusClass }}</span>
                        </p>
                    </div>

                    <div class="text-right">
                        <div class="text-3xl font-black text-green-500">
                            {{ offer.offers.at(0)!.premiumAmount }} {{ offer.offers.at(0)!.currency }}
                        </div>
                        <div class="text-xs text-slate-400">
                            valabil până la {{ offer.offers.at(0)!.offerExpiryDate }}
                        </div>
                    </div>
                </div>

                <!-- details grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                    <div class="space-y-1">
                        <p class="text-slate-500 uppercase text-xs tracking-widest">Perioadă</p>
                        <p>{{ offer.offers.at(0)!.startDate }} → {{ offer.offers.at(0)!.endDate }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-slate-500 uppercase text-xs tracking-widest">Comision</p>
                        <p>{{ offer.offers.at(0)!.commissionPercent }}% ({{ offer.offers.at(0)!.commissionValue }} {{ offer.offers.at(0)!.currency }})</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-slate-500 uppercase text-xs tracking-widest">Rata de referință</p>
                        <p>{{ offer.offers.at(0)!.referenceRate }}</p>
                    </div>
                </div>

                <!-- installments -->
                <div v-if="offer.offers.at(0)!.installments?.length" class="mt-6">
                    <details class="group">
                        <summary class="cursor-pointer text-green-400 font-semibold">
                            Vezi ratele
                        </summary>

                        <div class="mt-4 space-y-2">
                            <div
                                v-for="inst in offer.offers.at(0)!.installments"
                                :key="inst.id"
                                class="flex justify-between rounded-xl bg-slate-950/40
                       border border-slate-800 px-5 py-3"
                            >
                                <span>{{ inst.dueDate }}</span>
                                <span class="font-bold">{{ inst.amount }} {{ offer.offers.at(0)!.currency }}</span>
                            </div>
                        </div>
                    </details>
                </div>

                <!-- Offer actions -->
                <div class="mt-6 w-full flex justify-between items-center">
                    <div>
                        <a
                            :href="`/offers/${offer.offers.at(0)!.offerId}`"
                            class="rounded-2xl bg-green-500 px-8 py-4 font-black text-slate-950 hover:bg-green-400 transition shadow-[0_0_30px_rgba(34,197,94,0.35)]"
                        >
                            Descarcă Oferta
                        </a>
                    </div>

                    <!-- TODO handle transforma in polita -->
                    <div>
                        <a
                            :href="`/offers/${offer.offers.at(0)!.offerId}/policies?amount=${offer.offers.at(0)!.premiumAmount}&currency=${offer.offers.at(0)!.currency}&date=${offer.offers.at(0)!.startDate}`"
                            class="rounded-2xl bg-green-500 px-8 py-4 font-black text-slate-950
                       hover:bg-green-400 transition shadow-[0_0_30px_rgba(34,197,94,0.35)]"
                        >
                            Transformă în Poliță & Descarcă
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
</style>
