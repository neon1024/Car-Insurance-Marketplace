<script setup lang="ts">

import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { PageProps } from '@/types/inertia';
import { computed, ref, watch } from 'vue';

const page = usePage<PageProps>();

const token = computed(() => page.props.session.token);

const counties = ref<Array<{ code: string; name: string }>>([]);

const countyCodePolicyHolder = ref<string>("");
const countyCodeVehicleOwner = ref<string>("");

const citiesPolicyHolder = ref<Array<{ siruta: string, name: string }>>([]);
const citiesVehicleOwner = ref<Array<{ siruta: string, name: string }>>([]);

const cityPolicyHolder = ref<{ siruta: string, name: string }>({ siruta: "", name: "" });
const cityVehicleOwner = ref<{ siruta: string, name: string }>({ siruta: "", name: "" });

// TODO re route in backend to login when token / session expires
const handleGetOffers = () => {
    router.post("/offers");
}

const getCounties = async () => {
    try {
        const response = await axios.get("/api/counties", {
            headers: {
                Token: token.value
            }
        });

        const data = response.data;

        const error = data.error;

        if(error) {
            const status = data.status;
            const message = data.message;

            console.log("error", error);
            console.log("status", status);
            console.log("message", message);

            return;
        }

        counties.value = data.data;
    } catch(error) {
        console.log(error);
    }
}

const getCitiesByCountyCode = async (cities, countyCode) => {
    try {
        const response = await axios.get(`/api/cities/${countyCode.value}`, {
            headers: {
                Token: token.value
            }
        });

        const data = response.data;

        const error = data.error;

        if(error) {
            const status = data.status;
            const message = data.message;

            console.log("error", error);
            console.log("status", status);
            console.log("message", message);

            return;
        }

        cities.value = data.data;
    } catch(error) {
        console.log(error);
    }
}

getCounties();

watch(countyCodePolicyHolder, async () => getCitiesByCountyCode(citiesPolicyHolder, countyCodePolicyHolder));
watch(countyCodeVehicleOwner, async () => getCitiesByCountyCode(citiesVehicleOwner, countyCodeVehicleOwner));

watch(cityPolicyHolder, async () => alert("PH" + " " + cityPolicyHolder.value.name));
watch(cityVehicleOwner, async () => alert("VO" + " " + cityVehicleOwner.value.name));

</script>

<template>
    <body>
    <div class="min-h-screen bg-slate-900 flex flex-col">
        <header class="py-6 text-center">
            <h1 class="text-3xl font-bold text-white">Oferte</h1>
        </header>
        <main>
            <form
                @submit.prevent="handleGetOffers"
                class="
                    flex flex-col mx-auto
                    w-full
                    max-w-450
                    space-y-4
                    px-4
                    py-6
                    bg-slate-950
                    border-2
                    border-green-600
                    rounded-lg
                    shadow
                    mt-16
                    mb-16
                "
            >
                <!-- TODO remove asiguratori care nu merg -->
                <!-- Insurance Provider (provider.organization:) -->
                <label class="text-3xl">Asigurator</label>
                <div class="relative">
                    <select
                        required
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege asigurator</option>

                        <option value="allianz">Allianz</option>
                        <option value="asirom">Asirom</option>
                        <option value="axeria">Axeria</option>
                        <option value="generali">Generali</option>
                        <option value="groupama">Groupama</option>
                        <option value="omniasig">Omniasig</option>
                        <option value="hellas_autonom">Hellas Autonom</option>
                        <option value="hellas_nextins">Hellas NextIns</option>
                        <option value="grawe">Grawe</option>
                        <option value="eazy_insure">Eazy Insure</option>
                    </select>

                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <!-- product.motor: -->
                <label class="text-3xl">Date asigurare</label>

                <div class="flex items-center gap-3">
                    <label for="data_inceperii" class="text-white text-right text-lg">
                        Data inceperii:
                    </label>
                    <input
                        id="data_inceperii"
                        type="date"
                        class="
                            w-45
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            placeholder-slate-400
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                        "
                    />
                </div>

                <!-- TODO validare <= 12 -->
                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        Durata in luni:
                    </label>
                    <input
                        id="durata"
                        type="number"
                        placeholder="Numar"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <!-- product.motor.renewPolicy.series? "XX/XX/XX" -->
                <!-- product.motor.renewPolicy.number? 123456789 -->

                <!-- Business Details (product.policyholder:) -->
                <label class="text-3xl">Date titular</label>

                <label class="flex items-center gap-2 text-white">
                    <span>Persoana Fizica</span>
                    <input
                        type="checkbox"
                        class="h-4 w-4 accent-green-500"
                    />
                </label>

                <!-- TODO render field uri firma daca persoana juridica -->
                <input placeholder="Nume firma" type="text">
                <input placeholder="Numar registru firma" type="text">
                <input placeholder="Nume" type="text">
                <input placeholder="Prenume" type="text">

                <!-- TODO daca e firma atunci CUI, daca e persoana fizica atunci CNP -->
                <input placeholder="Cod Identificare Fiscala" type="text">
<!--                <input placeholder="CNP" type="text">-->

                <input placeholder="Email" type="email">
                <input placeholder="Telefon" type="text">

                <!-- product.policyholder.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Eliberat de" type="text">

                <!-- TODO doar Romania -->
                <!-- Address (product.policyholder.address:) -->
                <label>Adresa</label>

                <!-- only for Romania -->
                <label>Județ</label>
                <div class="relative">
                    <select
                        v-model="countyCodePolicyHolder"
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege județ</option>

                        <option v-for="county in counties" :key="county.code" :value="county.code">{{county.name}}</option>
                    </select>
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <!-- TODO select oras by county -->
                <label>Oras</label>
                <div class="relative">
                    <select
                        v-model="cityPolicyHolder"
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege orasul</option>

                        <option v-for="city in citiesPolicyHolder" :key="city.siruta" :value="{siruta: city.siruta, name: city.name}">{{city.name}}</option>
                    </select>
                </div>

                <!-- TODO codul SIRUTA este procesat in backend -->
                <input placeholder="Strada" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Bloc" type="text">
                <input placeholder="Scara" type="text">
                <input placeholder="Apartament" type="text">
                <input placeholder="Etaj" type="text">
                <input placeholder="Cod postal" type="text">

                <!-- Vehicle Info (product.vehicle.owner:) -->
                <label class="text-3xl">Date proprietar vehicul</label>

                <label class="flex items-center gap-2 text-white">
                    <span>Persoana Fizica</span>
                    <input
                        type="checkbox"
                        class="h-4 w-4 accent-green-500"
                    />
                </label>

                <!-- TODO daca e persoana juridica arata field urile pentru firma -->
                <input placeholder="Companie" type="text">
                <input placeholder="Cod registru" type="text">
                <input placeholder="Nume" type="text">
                <input placeholder="Prenume" type="text">

                <!-- TODO daca e persoana juridica CIF, daca e persoana fizica CNP -->
                <input placeholder="Cod Identificare Fiscala">
<!--                <input placeholder="CNP"/>-->

                <input placeholder="Email" type="email">
                <input placeholder="Telefon" type="text">

                <!-- Address (product.vehicle.owner.address:) -->
                <label>Adresa</label>

                <label>Județ</label>
                <div class="relative">
                    <select
                        v-model="countyCodeVehicleOwner"
                        class="
                                w-full
                                p-3
                                rounded
                                bg-slate-800
                                text-white
                                focus:outline-none
                                focus:ring-2
                                focus:ring-green-500
                                appearance-none
                            "
                    >
                        <option value="" disabled selected>Alege județ</option>

                        <option v-for="county in counties" :key="county.code" :value="county.code">{{county.name}}</option>
                    </select>
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <!-- TODO select oras by county -->
                <label>Oras</label>
                <div class="relative">
                    <select
                        v-model="cityVehicleOwner"
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege orasul</option>

                        <option v-for="city in citiesVehicleOwner" :key="city.siruta" :value="{ siruta: city.siruta, name: city.name }">{{city.name}}</option>
                    </select>
                </div>

                <!-- TODO codul SIRUTA este procesat in backend -->
                <input placeholder="Strada" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Bloc" type="text">
                <input placeholder="Scara" type="text">
                <input placeholder="Apartament" type="text">
                <input placeholder="Etaj" type="text">
                <input placeholder="Cod postal" type="text">

                <!-- TODO user ul poate adauga mai multi soferi -->
                <!-- Driver (product.vehicle.driver:) (lista de persoane care conduc masina) -->
                <label class="text-3xl">Date soferi</label>
                <input placeholder="Nume">
                <input placeholder="Prenume">
                <input placeholder="CNP">
                <!-- product.vehicle.driver.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie">
                <input placeholder="Numar">
                <input placeholder="Telefon">

                <!-- Car (product.vehicle:) -->
                <label class="text-3xl">Date vehicul</label>
                <input placeholder="Numar inmatriculare">

                <label>Tip inregistrare</label>
                <div class="relative">
                    <select
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege tip inregistrare</option>

                        <option value="registered">Inregistrat</option>
                        <option value="unregistered">Neinregistrat</option>
                    </select>
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <input placeholder="VIN">

                <!-- TODO v-for render -->
                <label>Tip vehicul</label>
                <div class="relative">
                    <select
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege tipul vehiculului</option>

                        <option value="M1">M1 – Autovehicule pentru transportul de persoane (≤8 locuri + șofer)</option>
                        <option value="M2">M2 – Autovehicule pentru transportul de persoane (>8 locuri, mediu)</option>
                        <option value="M3">M3 – Autovehicule pentru transportul de persoane (>8 locuri, greu)</option>
                        <option value="N1">N1 – Autovehicule pentru transportul de marfă (≤3,5 t)</option>
                        <option value="N2">N2 – Autovehicule pentru transportul de marfă (>3,5 t și ≤12 t)</option>
                        <option value="N3">N3 – Autovehicule pentru transportul de marfă (>12 t)</option>
                        <option value="O1">O1 – Remorci (≤0,75 t)</option>
                        <option value="O2">O2 – Remorci (>0,75 t și ≤3,5 t)</option>
                        <option value="O3">O3 – Remorci (>3,5 t și ≤10 t)</option>
                        <option value="O4">O4 – Remorci (>10 t)</option>
                        <option value="L1e">L1e – Vehicule cu două roți, ≤50 cm³</option>
                        <option value="L2e">L2e – Vehicule cu trei roți, ≤50 cm³</option>
                        <option value="L3e">L3e – Motociclete cu două roți, >50 cm³</option>
                        <option value="L4e">L4e – Motociclete cu două roți cu ataș, >50 cm³</option>
                        <option value="L5e">L5e – Tricicluri cu motor, >50 cm³</option>
                        <option value="L6e">L6e – Cvadraciclu ușor</option>
                        <option value="L7e">L7e – Cvadraciclu greu</option>
                    </select>
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <input placeholder="Marca">
                <input placeholder="Model">

                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        An fabricatie:
                    </label>
                    <input
                        id="an_fabricatie"
                        type="number"
                        placeholder="An"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        Capacitate motor:
                    </label>
                    <input
                        id="capacitate_motor"
                        type="number"
                        placeholder="Cm³"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        Putere motor:
                    </label>
                    <input
                        id="putere_motor"
                        type="number"
                        placeholder="Cai Putere"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        Greutate:
                    </label>
                    <input
                        id="greutate"
                        type="number"
                        placeholder="Kg"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <div class="flex items-center gap-3">
                    <label for="age" class="text-white text-right">
                        Locuri:
                    </label>
                    <input
                        id="locuri"
                        type="number"
                        placeholder="Numar"
                        class="w-45 p-3 rounded bg-slate-800 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                </div>

                <label>Combustibil</label>
                <div class="relative">
                    <select
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege tipul combustibilului</option>

                        <option value="diesel">Diesel</option>
                        <option value="petrol">Benzină</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="electric">Electric</option>
                    </select>
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                        ▼
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <label for="prima_inregistrare" class="text-white text-right text-lg">
                        Prima inregistrare:
                    </label>
                    <input
                        id="prima_inregistrare"
                        type="date"
                        class="
                            w-45
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            placeholder-slate-400
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                        "
                    />
                </div>

                <label>Tip uz</label>
                <div class="relative">
                    <select
                        class="
                            w-full
                            p-3
                            rounded
                            bg-slate-800
                            text-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            appearance-none
                        "
                    >
                        <option value="" disabled selected>Alege tip uz</option>

                        <option value="personal">Personal</option>
                    </select>
                </div>

                <input placeholder="CIV">

                <label class="flex items-center gap-2 text-white">
                    <span>Vehicul achizitionat de la dealer roman</span>
                    <input
                        type="checkbox"
                        class="h-4 w-4 accent-green-500"
                    />
                </label>

                <button type="submit" @click="handleGetOffers">Get Offers</button>
            </form>
        </main>
        <footer>
        </footer>
        </div>
    </body>
</template>

<style scoped>

</style>
