<script setup lang="ts">

import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, ref, watch } from 'vue';
import Snackbar from '@/components/Snackbar.vue';

const counties = ref<Array<{ code: string; name: string }>>([]);

const citiesPolicyHolder = ref<Array<{ siruta: string, name: string }>>([]);
const citiesVehicleOwner = ref<Array<{ siruta: string, name: string }>>([]);

const isNaturalPersonPolicyHolder = ref(false);
const isNaturalPersonVehicleOwner = ref(false);

const snackbarVisible = ref(false);
const snackbarText = ref("");

// TODO add necessary fields for all insurers' requests
const formData = ref({
    insuranceStartDate: "",
    insuranceDurationInMonths: 12,

    policyHolderBusinessName: "",
    policyHolderBusinessRegisterNumber: "",
    policyHolderBusinessCAENCode: "",
    policyHolderBusinessCUI: "",

    policyHolderLastName: "",
    policyHolderFirstName: "",
    policyHolderCNP: "",
    policyHolderEmail: "",
    policyHolderPhone: "",

    policyHolderCountyCode: "",
    policyHolderCity: { siruta: "", name: "" },
    policyHolderStreet: "",
    policyHolderHouseNumber: "",
    policyHolderBuilding: "",
    policyHolderStaircase: "",
    policyHolderApartment: "",
    policyHolderFloor: "",
    policyHolderPostcode: "",

    vehicleOwnerBusinessName: "",
    vehicleOwnerBusinessRegisterNumber: "",
    vehicleOwnerBusinessCAENCode: "",
    vehicleOwnerBusinessCUI: "",

    vehicleOwnerLastName: "",
    vehicleOwnerFirstName: "",
    vehicleOwnerCNP: "",
    vehicleOwnerEmail: "",
    vehicleOwnerPhone: "",

    vehicleOwnerCountyCode: "",
    vehicleOwnerCity: { siruta: "", name: "" },
    vehicleOwnerStreet: "",
    vehicleOwnerHouseNumber: "",
    vehicleOwnerBuilding: "",
    vehicleOwnerStaircase: "",
    vehicleOwnerApartment: "",
    vehicleOwnerFloor: "",
    vehicleOwnerPostcode: "",

    driverLastName: "",
    driverFirstName: "",
    driverCNP: "",
    driverIDSeries: "",
    driverIDNumber: "",
    driverPhone: "",

    vehicleLicensePlate: "",
    vehicleRegistrationType: "",
    vehicleVIN: "",
    vehicleType: "",
    vehicleBrand: "",
    vehicleModel: "",
    vehicleYearOfConstruction: "",
    vehicleEngineDisplacement: "",
    vehicleEnginePower: "",
    vehicleTotalWeight: "",
    vehicleSeats: "",
    vehicleFuelType: "",
    vehicleFirstRegistration: "",
    vehicleUsageType: "",
    vehicleCIV: "",
    vehicleCurrentMileage: "",
    vehicleExpirationDatePti: "",

    isAcquiredFromRomanianDealer: true
});

// TODO form data directly formatted as the request body
const formData1 = ref({
    "product": {
        "motor": {
            "startDate": "",
            "termTime": 12
        },
        "policyholder": {
            "businessName": "",
            "companyRegistryNumber": "",
            "caenCode": "",
            "lastName": "",
            "firstName": "",
            "isForeignPerson": false,
            "taxId": "",
            "nationality": "RO",
            "citizenship": "RO",
            "gender": "",
            "birthdate": "",
            "email": "",
            "mobileNumber": "",
            "identification": {
                "idType": "",
                "idNumber": "",
                "issueAuthority": "",
                "issueDate": ""
            },
            "drivingLicense": {
                "issueDate": ""
            },
            "address": {
                "country": "",
                "county": "",
                "city": "",
                "cityCode": "",
                "street": "",
                "houseNumber": "",
                "building": "",
                "floor": "",
                "staircase": "",
                "apartment": "",
                "postcode": ""
            },
            "hasDisability": false,
            "isRetired": false
        },
        "vehicle": {
            "registrationType": "",
            "owner": {
                "businessName": "",
                "companyRegistryNumber": "",
                "caenCode": "",
                "lastName": "",
                "firstName": "",
                "isForeignPerson": false,
                "taxId": "",
                "nationality": "RO",
                "citizenship": "RO",
                "gender": "",
                "birthdate": "",
                "email": "",
                "mobileNumber": "",
                "identification": {
                    "idType": "",
                    "idNumber": "",
                    "issueAuthority": "",
                    "issueDate": ""
                },
                "drivingLicense": {
                    "issueDate": ""
                },
                "address": {
                    "country": "RO",
                    "county": "",
                    "city": "",
                    "cityCode": "",
                    "street": "",
                    "houseNumber": "",
                    "building": "",
                    "floor": "",
                    "staircase": "",
                    "apartment": "",
                    "postcode": ""
                },
                "hasDisability": false,
                "isRetired": false
            },
            "driver": [],
            "licensePlate": "",
            "vin": "",
            "vehicleType": "",
            "brand": "",
            "model": "",
            "yearOfConstruction": "",
            "engineDisplacement": "",
            "seats": "",
            "enginePower": "",
            "totalWeight": "",
            "fuelType": "petrol",
            "firstRegistration": "",
            "usageType": "",
            "currentMileage": "",
            "hasMobilityModifications": false,
            "isLeased": false,
            "identification": {
                "idNumber": ""
            }
        },
        "additionalData": []
    }
});

// test form data
const formData2 = ref({
    "product": {
        "motor": {
            "startDate": "2026-02-28",
            "termTime": 12
        },
        "policyholder": {
            "lastName": "Corcodel",
            "firstName": "Gheorghe",
            "isForeignPerson": false,
            "taxId": "1620607151238",
            "nationality": "RO",
            "citizenship": "RO",
            "gender": "m",
            "birthdate": "1962-06-07",
            "email": "comenzi1769157661@roviniete.ro",
            "mobileNumber": "0717691576",
            "identification": {
                "idType": "CI",
                "idNumber": "TZ790205",
                "issueAuthority": "SPCLEPTM",
                "issueDate": "2025-01-23"
            },
            "drivingLicense": {
                "issueDate": "1982-01-01"
            },
            "address": {
                "country": "RO",
                "county": "TM",
                "city": "LOVRIN",
                "cityCode": 157549,
                "street": "Principala",
                "houseNumber": "625",
                "building": "1",
                "floor": "1",
                "staircase": "",
                "apartment": "",
                "postcode": "307250"
            },
            "hasDisability": false,
            "isRetired": false
        },
        "vehicle": {
            "registrationType": "registered",
            "owner": {
                "lastName": "Corcodel",
                "firstName": "Gheorghe",
                "isForeignPerson": false,
                "taxId": "1620607151238",
                "nationality": "RO",
                "citizenship": "RO",
                "gender": "m",
                "birthdate": "1962-06-07",
                "email": "comenzi1769157661@roviniete.ro",
                "mobileNumber": "0717691576",
                "identification": {
                    "idType": "CI",
                    "idNumber": "TZ790205",
                    "issueAuthority": "SPCLEPTM",
                    "issueDate": "2025-01-23"
                },
                "drivingLicense": {
                    "issueDate": "1982-01-01"
                },
                "address": {
                    "country": "RO",
                    "county": "TM",
                    "city": "LOVRIN",
                    "cityCode": 157549,
                    "street": "Principala",
                    "houseNumber": "625",
                    "building": "1",
                    "floor": "1",
                    "staircase": "",
                    "apartment": "",
                    "postcode": "307250"
                },
                "hasDisability": false,
                "isRetired": false
            },
            "driver": [],
            "licensePlate": "TM23KPR",
            "vin": "WVWZZZ3BZ3P447031",
            "vehicleType": "M1",
            "brand": "volkswagen",
            "model": "passat",
            "yearOfConstruction": 2003,
            "engineDisplacement": 1896,
            "seats": 5,
            "enginePower": 96,
            "totalWeight": 1970,
            "fuelType": "petrol",
            "firstRegistration": "2003-01-01",
            "usageType": "personal",
            "currentMileage": 120056,
            "hasMobilityModifications": false,
            "isLeased": false,
            "identification": {
                "idNumber": "O000000"
            }
        },
        "additionalData": []
    }
});

const policyHolderTaxId = computed({
    get() {
        return isNaturalPersonPolicyHolder.value ?
            formData.value.policyHolderCNP :
            formData.value.policyHolderBusinessCUI;
    },
    set(value) {
        if(isNaturalPersonPolicyHolder.value) {
            formData.value.policyHolderCNP = value;
        } else {
            formData.value.policyHolderBusinessCUI = value;
        }
    }
});

const vehicleOwnerTaxId = computed({
    get() {
        return isNaturalPersonVehicleOwner.value ?
            formData.value.vehicleOwnerCNP :
            formData.value.vehicleOwnerBusinessCUI;
    },
    set(value) {
        if(isNaturalPersonVehicleOwner.value) {
            formData.value.vehicleOwnerCNP = value;
        } else {
            formData.value.vehicleOwnerBusinessCUI = value;
        }
    }
});

// TODO validare field uri care necesita validare
const validateFormData = () => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const [year, month, day] = formData.value.insuranceStartDate.split('-').map(Number);
    const selectedDate = new Date(year, month - 1, day); // months are 0 indexed

    if (selectedDate <= today) {
        snackbarText.value = "Data începerii trebuie să fie cel mai devreme mâine";
        snackbarVisible.value = true;
        return false;
    }

    if(0 > formData.value.insuranceDurationInMonths || formData.value.insuranceDurationInMonths > 12) {
        snackbarText.value = "Durata in luni trebuie sa fie intre 1 si 12 luni";
        snackbarVisible.value = true;

        return false;
    }

    if(parseInt(formData.value.vehicleCurrentMileage) <= 0) {
        snackbarText.value = "Kilometrajul trebuie sa fie un numar mai mare decat 0";
        snackbarVisible.value = true;

        return false;
    }

    return true;
}

// TODO re route in backend to login when token / session expires
const handleGetOffers = async () => {
    router.post("/offers", formData2.value);

    return;

    if(!validateFormData()) {
        return;
    }

    // TODO if normal person => remove company fields
    // TODO if car is registered => remove license plate field

    // TODO send only the request()->all in the request
    const data = {
        insuranceStartDate: formData.value.insuranceStartDate,
        insuranceDurationInMonths: formData.value.insuranceDurationInMonths,

        policyHolderBusinessName: formData.value.policyHolderBusinessName,
        policyHolderBusinessRegisterNumber: formData.value.policyHolderBusinessRegisterNumber,
        policyHolderBusinessCAENCode: parseInt(formData.value.policyHolderBusinessCAENCode),
        policyHolderBusinessCUI: formData.value.policyHolderBusinessCUI,

        policyHolderLastName: formData.value.policyHolderLastName,
        policyHolderFirstName: formData.value.policyHolderFirstName,
        policyHolderCNP: formData.value.policyHolderCNP,
        policyHolderEmail: formData.value.policyHolderEmail,
        policyHolderPhone: formData.value.policyHolderPhone,

        policyHolderCountyCode: formData.value.policyHolderCountyCode,
        policyHolderCity: formData.value.policyHolderCity.name,
        policyHolderCityCode: parseInt(formData.value.policyHolderCity.siruta),
        policyHolderStreet: formData.value.policyHolderStreet,
        policyHolderHouseNumber: formData.value.policyHolderHouseNumber,
        policyHolderBuilding: formData.value.policyHolderBuilding,
        policyHolderStaircase: formData.value.policyHolderStaircase,
        policyHolderApartment: formData.value.policyHolderApartment,
        policyHolderFloor: formData.value.policyHolderFloor,
        policyHolderPostcode: formData.value.policyHolderPostcode,

        vehicleOwnerBusinessName: formData.value.vehicleOwnerBusinessName,
        vehicleOwnerBusinessRegisterNumber: formData.value.vehicleOwnerBusinessRegisterNumber,
        vehicleOwnerBusinessCAENCode: parseInt(formData.value.vehicleOwnerBusinessCAENCode),
        vehicleOwnerBusinessCUI: formData.value.vehicleOwnerBusinessCUI,

        vehicleOwnerLastName: formData.value.vehicleOwnerLastName,
        vehicleOwnerFirstName: formData.value.vehicleOwnerFirstName,
        vehicleOwnerCNP: formData.value.vehicleOwnerCNP,
        vehicleOwnerEmail: formData.value.vehicleOwnerEmail,
        vehicleOwnerPhone: formData.value.vehicleOwnerPhone,

        vehicleOwnerCountyCode: formData.value.vehicleOwnerCountyCode,
        vehicleOwnerCity: formData.value.vehicleOwnerCity.name,
        vehicleOwnerCityCode: (formData.value.vehicleOwnerCity.siruta),
        vehicleOwnerStreet: formData.value.vehicleOwnerStreet,
        vehicleOwnerHouseNumber: formData.value.vehicleOwnerHouseNumber,
        vehicleOwnerBuilding: formData.value.vehicleOwnerBuilding,
        vehicleOwnerStaircase: formData.value.vehicleOwnerStaircase,
        vehicleOwnerApartment: formData.value.vehicleOwnerApartment,
        vehicleOwnerFloor: formData.value.vehicleOwnerFloor,
        vehicleOwnerPostcode: formData.value.vehicleOwnerPostcode,

        driverLastName: formData.value.driverLastName,
        driverFirstName: formData.value.driverFirstName,
        driverCNP: formData.value.driverCNP,
        driverIDSeries: formData.value.driverIDSeries,
        driverIDNumber: formData.value.driverIDNumber,
        driverPhone: formData.value.driverPhone,

        vehicleLicensePlate: formData.value.vehicleLicensePlate,
        vehicleRegistrationType: formData.value.vehicleRegistrationType,
        vehicleVIN: formData.value.vehicleVIN,
        vehicleType: formData.value.vehicleType,
        vehicleBrand: formData.value.vehicleBrand,
        vehicleModel: formData.value.vehicleModel,
        vehicleYearOfConstruction: parseInt(formData.value.vehicleYearOfConstruction),
        vehicleEngineDisplacement: parseInt(formData.value.vehicleEngineDisplacement),
        vehicleEnginePower: parseInt(formData.value.vehicleEnginePower),
        vehicleTotalWeight: parseInt(formData.value.vehicleTotalWeight),
        vehicleSeats: parseInt(formData.value.vehicleSeats),
        vehicleFuelType: formData.value.vehicleFuelType,
        vehicleFirstRegistration: formData.value.vehicleFirstRegistration,
        vehicleUsageType: formData.value.vehicleUsageType,
        vehicleCIV: formData.value.vehicleCIV,

        vehicleCurrentMileage: parseInt(formData.value.vehicleCurrentMileage),

        isAcquiredFromRomanianDealer: formData.value.isAcquiredFromRomanianDealer,
        vehicleExpirationDatePti: formData.value.vehicleExpirationDatePti
    };

    router.post("/offers", data);
}

const getCounties = async () => {
    try {
        const response = await axios.get("/api/counties");

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
    if(!countyCode) {
        return;
    }

    try {
        const response = await axios.get(`/api/cities/${countyCode}`);

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

watch(() => formData.value.policyHolderCountyCode, async () => getCitiesByCountyCode(citiesPolicyHolder, formData.value.policyHolderCountyCode));
watch(() => formData.value.vehicleOwnerCountyCode, async () => getCitiesByCountyCode(citiesVehicleOwner, formData.value.vehicleOwnerCountyCode));

</script>

<template>
    <div class="min-h-screen bg-slate-900 bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-slate-950 text-slate-200">
        <header class="py-12 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                Configurator <span class="text-green-500">Oferte</span>
            </h1>
            <p class="mt-3 text-slate-400 font-medium">Completează datele de mai jos pentru a obține instant oferte de asigurare RCA</p>
        </header>

        <!-- TODO remove novalidate -->
        <main class="max-w-4xl mx-auto px-6 pb-24">
            <form novalidate @submit.prevent="handleGetOffers" class="relative overflow-hidden bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-2xl">

                <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-green-500/50 to-transparent"></div>

                <div class="p-8 md:p-12 space-y-16">

                    <section class="space-y-6">
                        <h2 class="text-2xl font-bold text-white border-b border-slate-800 pb-4 tracking-tight">Date asigurare</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-slate-500 ml-1 tracking-widest">Data începerii</label>
                                <input v-model="formData.insuranceStartDate" type="date" required style="color-scheme: dark;" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white focus:border-green-500 outline-none transition-all" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-slate-500 ml-1 tracking-widest">Durata în luni</label>
                                <input v-model="formData.insuranceDurationInMonths" type="number" placeholder="ex: 12" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white focus:border-green-500 outline-none transition-all" />
                            </div>
                        </div>
                    </section>

                    <section class="p-8 rounded-2xl bg-slate-950/30 border border-slate-800/50 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-6">
                            <h2 class="text-2xl font-bold text-white">Date titular</h2>
                            <label class="inline-flex items-center cursor-pointer group">
                                <span class="mr-3 text-sm font-medium text-slate-400 group-hover:text-slate-200 transition">Persoană Fizică</span>
                                <div class="relative">
                                    <input type="checkbox" v-model="isNaturalPersonPolicyHolder" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-700 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full relative"></div>
                                </div>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <template v-if="!isNaturalPersonPolicyHolder">
                                <input v-model="formData.policyHolderBusinessName" placeholder="Companie" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                                <input v-model="formData.policyHolderBusinessRegisterNumber" placeholder="Cod registru" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                                <input v-model="formData.policyHolderBusinessCAENCode" placeholder="Cod CAEN" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            </template>
                            <input v-model="formData.policyHolderLastName" placeholder="Nume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="formData.policyHolderFirstName" placeholder="Prenume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="policyHolderTaxId" :placeholder="isNaturalPersonPolicyHolder ? 'CNP' : 'CUI'" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="formData.policyHolderEmail" placeholder="Email" type="email" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            <input v-model="formData.policyHolderPhone" placeholder="Telefon" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />

<!--                            <div class="md:col-span-2 grid grid-cols-3 gap-4">-->
<!--                                <input placeholder="Serie CI" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />-->
<!--                                <input placeholder="Numar CI" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />-->
<!--                                <input placeholder="Eliberat de" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />-->
<!--                            </div>-->
                        </div>

                        <div class="space-y-6 pt-4">
                            <h3 class="font-bold text-green-500 uppercase text-xs tracking-[0.2em]">Adresă titular</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="relative group">
                                    <select v-model="formData.policyHolderCountyCode" required class="w-full appearance-none rounded-2xl bg-slate-950/60 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                        <option value="" disabled class="bg-slate-900 text-slate-400">Alege județ</option>
                                        <option v-for="county in counties" :key="county.code" :value="county.code" class="bg-slate-900 text-white">{{county.name}}</option>
                                    </select>
                                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                                </div>
                                <div class="relative group">
                                    <select v-model="formData.policyHolderCity" required class="w-full appearance-none rounded-2xl bg-slate-950/60 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                        <option value="" disabled class="bg-slate-900 text-slate-400">Alege orașul</option>
                                        <option v-for="city in citiesPolicyHolder" :key="city.siruta" :value="{siruta: city.siruta, name: city.name}" class="bg-slate-900 text-white">{{city.name}}</option>
                                    </select>
                                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <input v-model="formData.policyHolderStreet" placeholder="Strada" required class="col-span-2 w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderHouseNumber" placeholder="Numar" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderBuilding" placeholder="Bloc" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderStaircase" placeholder="Scara" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderApartment" placeholder="Apartament" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderFloor" placeholder="Etaj" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.policyHolderPostcode" placeholder="Cod poștal" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            </div>
                        </div>
                    </section>

                    <section class="p-8 rounded-2xl bg-slate-950/30 border border-slate-800/50 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-6">
                            <h2 class="text-2xl font-bold text-white">Date proprietar vehicul</h2>
                            <label class="inline-flex items-center cursor-pointer group">
                                <span class="mr-3 text-sm font-medium text-slate-400 group-hover:text-slate-200 transition">Persoană Fizică</span>
                                <div class="relative">
                                    <input type="checkbox" v-model="isNaturalPersonVehicleOwner" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-700 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full relative"></div>
                                </div>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <template v-if="!isNaturalPersonVehicleOwner">
                                <input v-model="formData.vehicleOwnerBusinessName" placeholder="Companie" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                                <input v-model="formData.vehicleOwnerBusinessRegisterNumber" placeholder="Cod registru" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                                <input v-model="formData.vehicleOwnerBusinessCAENCode" placeholder="Cod CAEN" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                            </template>
                            <input v-model="formData.vehicleOwnerLastName" placeholder="Nume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                            <input v-model="formData.vehicleOwnerFirstName" placeholder="Prenume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                            <input v-model="vehicleOwnerTaxId" :placeholder="isNaturalPersonVehicleOwner ? 'CNP' : 'CUI'" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50" />
                            <input v-model="formData.vehicleOwnerEmail" placeholder="Email" type="email" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            <input v-model="formData.vehicleOwnerPhone" placeholder="Telefon" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                        </div>

                        <div class="space-y-6 pt-4">
                            <h3 class="font-bold text-green-500 uppercase text-xs tracking-[0.2em]">Adresă proprietar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="relative group">
                                    <select v-model="formData.vehicleOwnerCountyCode" required class="w-full appearance-none rounded-2xl bg-slate-950/60 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                        <option value="" disabled class="bg-slate-900 text-slate-400">Alege județ</option>
                                        <option v-for="county in counties" :key="county.code" :value="county.code" class="bg-slate-900 text-white">{{county.name}}</option>
                                    </select>
                                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                                </div>
                                <div class="relative group">
                                    <select v-model="formData.vehicleOwnerCity" required class="w-full appearance-none rounded-2xl bg-slate-950/60 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                        <option value="" disabled class="bg-slate-900 text-slate-400">Alege orașul</option>
                                        <option v-for="city in citiesVehicleOwner" :key="city.siruta" :value="{ siruta: city.siruta, name: city.name }" class="bg-slate-900 text-white">{{city.name}}</option>
                                    </select>
                                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <input v-model="formData.vehicleOwnerStreet" placeholder="Strada" required class="col-span-2 w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerHouseNumber" placeholder="Numar" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerBuilding" placeholder="Bloc" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerStaircase" placeholder="Scara" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerApartment" placeholder="Apartament" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerFloor" placeholder="Etaj" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                                <input v-model="formData.vehicleOwnerPostcode" placeholder="Cod postal" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            </div>
                        </div>
                    </section>

                    <section class="space-y-6">
                        <h2 class="text-2xl font-bold text-white border-b border-slate-800 pb-4">Date soferi</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <input v-model="formData.driverLastName" placeholder="Nume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="formData.driverFirstName" placeholder="Prenume" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="formData.driverCNP" placeholder="CNP" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                            <input v-model="formData.driverIDSeries" placeholder="Serie" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            <input v-model="formData.driverIDNumber" placeholder="Numar" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            <input v-model="formData.driverPhone" placeholder="Telefon" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                        </div>
                    </section>

                    <section class="space-y-8 mb-8">
                        <h2 class="text-2xl font-bold text-white border-b border-slate-800 pb-4 tracking-tight">Date vehicul</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input v-model="formData.vehicleLicensePlate" placeholder="Numar inmatriculare" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white uppercase outline-none focus:border-green-500/50" />
                            <div class="relative group">
                                <select v-model="formData.vehicleRegistrationType" required class="w-full appearance-none rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                    <option value="" disabled selected class="bg-slate-900 text-slate-400">Alege tip inregistrare</option>
                                    <option value="registered" class="bg-slate-900 text-white">Inregistrat</option>
                                    <option value="unregistered" class="bg-slate-900 text-white">Neinregistrat</option>
                                </select>
                                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                            </div>

                            <input v-model="formData.vehicleVIN" placeholder="VIN" required class="md:col-span-2 w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white uppercase outline-none focus:border-green-500/50" />

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-[10px] uppercase text-slate-500 font-bold ml-1">Tip vehicul</label>
                                <div class="relative">
                                    <select v-model="formData.vehicleType" required class="w-full appearance-none rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer">
                                        <option value="" disabled selected class="bg-slate-900 text-slate-400">Alege tipul vehiculului</option>

                                        <option value="L" class="bg-slate-900 text-white">L – Vehicule cu mai puțin de patru roți și unele patru roți ușoare</option>
                                        <option value="L1" class="bg-slate-900 text-white">L1 – Vehicul cu două roți, capacitate ≤50 cm³, viteză ≤50 km/h</option>
                                        <option value="L2" class="bg-slate-900 text-white">L2 – Vehicul cu trei roți, capacitate ≤50 cm³, viteză ≤50 km/h</option>
                                        <option value="L3" class="bg-slate-900 text-white">L3 – Vehicul cu două roți, capacitate >50 cm³ sau viteză >50 km/h</option>
                                        <option value="L4" class="bg-slate-900 text-white">L4 – Vehicul cu trei roți asimetric, capacitate >50 cm³ sau viteză >50 km/h (motociclete cu sidecar)</option>
                                        <option value="L5" class="bg-slate-900 text-white">L5 – Vehicul cu trei roți simetric, capacitate >50 cm³ sau viteză >50 km/h</option>
                                        <option value="L6" class="bg-slate-900 text-white">L6 – Vehicul cu patru roți, masă ≤350 kg, viteză ≤45 km/h, capacitate ≤50 cm³ sau putere ≤4 kW</option>
                                        <option value="L7" class="bg-slate-900 text-white">L7 – Vehicul cu patru roți, masă ≤400 kg (550 kg pentru transport marfă), putere ≤15 kW</option>

                                        <option value="M" class="bg-slate-900 text-white">M – Vehicule cu cel puțin patru roți pentru transport persoane</option>
                                        <option value="M1" class="bg-slate-900 text-white">M1 – Transport persoane, până la 8 locuri + șofer</option>
                                        <option value="M2" class="bg-slate-900 text-white">M2 – Transport persoane, >8 locuri + șofer, masă ≤5 t</option>
                                        <option value="M3" class="bg-slate-900 text-white">M3 – Transport persoane, >8 locuri + șofer, masă >5 t</option>

                                        <option value="N" class="bg-slate-900 text-white">N – Vehicule cu cel puțin patru roți pentru transport marfă</option>
                                        <option value="N1" class="bg-slate-900 text-white">N1 – Transport marfă (≤3,5 t)</option>
                                        <option value="N2" class="bg-slate-900 text-white">N2 – Transport marfă (>3,5 t, ≤12 t)</option>
                                        <option value="N3" class="bg-slate-900 text-white">N3 – Transport marfă (>12 t)</option>

                                        <option value="O" class="bg-slate-900 text-white">O – Remorci</option>
                                        <option value="O1" class="bg-slate-900 text-white">O1 – Remorcă ≤0,75 t</option>
                                        <option value="O2" class="bg-slate-900 text-white">O2 – Remorcă >0,75 t, ≤3,5 t</option>
                                        <option value="O3" class="bg-slate-900 text-white">O3 – Remorcă >3,5 t, ≤10 t</option>
                                        <option value="O4" class="bg-slate-900 text-white">O4 – Remorcă >10 t</option>

                                        <option value="T" class="bg-slate-900 text-white">T – Vehicul agricol sau forestier motorizat</option>
                                        <option value="R" class="bg-slate-900 text-white">R – Remorcă agricolă, raport masă ≥3,0</option>
                                        <option value="S" class="bg-slate-900 text-white">S – Echipament tractat interschimbabil agricol/forestier, raport masă <3,0</option>

                                        <option value="G" class="bg-slate-900 text-white">G – Vehicule off-road</option>
                                    </select>
                                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                                </div>
                            </div>

                            <input v-model="formData.vehicleBrand" placeholder="Marca" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />
                            <input v-model="formData.vehicleModel" placeholder="Model" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none" />

                            <div class="md:col-span-2 grid grid-cols-2 md:grid-cols-5 gap-4">
                                <div class="space-y-1"><label class="text-[10px] uppercase text-slate-500 font-bold ml-1">An</label>
                                    <input v-model="formData.vehicleYearOfConstruction" type="number" placeholder="An" required class="w-full rounded-xl bg-slate-950/40 border border-slate-700/50 px-4 py-3 text-white outline-none" /></div>
                                <div class="space-y-1"><label class="text-[10px] uppercase text-slate-500 font-bold ml-1">Cm³</label>
                                    <input v-model="formData.vehicleEngineDisplacement" type="number" placeholder="Cm³" required class="w-full rounded-xl bg-slate-950/40 border border-slate-700/50 px-4 py-3 text-white outline-none" /></div>
                                <div class="space-y-1"><label class="text-[10px] uppercase text-slate-500 font-bold ml-1">Cai Putere</label>
                                    <input v-model="formData.vehicleEnginePower" type="number" placeholder="CP" required class="w-full rounded-xl bg-slate-950/40 border border-slate-700/50 px-4 py-3 text-white outline-none" /></div>
                                <div class="space-y-1"><label class="text-[10px] uppercase text-slate-500 font-bold ml-1">Masă totală</label>
                                    <input v-model="formData.vehicleTotalWeight" type="number" placeholder="Kg" required class="w-full rounded-xl bg-slate-950/40 border border-slate-700/50 px-4 py-3 text-white outline-none" /></div>
                                <div class="space-y-1"><label class="text-[10px] uppercase text-slate-500 font-bold ml-1">Locuri</label>
                                    <input v-model="formData.vehicleSeats" type="number" placeholder="Nr." required class="w-full rounded-xl bg-slate-950/40 border border-slate-700/50 px-4 py-3 text-white outline-none" /></div>
                            </div>
                        </div>
                    </section>

                    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-6 items-end mb-8">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-slate-500 font-bold ml-1 tracking-widest">Combustibil</label>
                            <div class="relative">
                                <select v-model="formData.vehicleFuelType" required class="w-full appearance-none rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer transition-all">
                                    <option value="" disabled selected class="bg-slate-900 text-slate-400">Alege...</option>
                                    <option value="diesel" class="bg-slate-900 text-white">Diesel</option>
                                    <option value="petrol" class="bg-slate-900 text-white">Benzină</option>
                                    <option value="hybrid" class="bg-slate-900 text-white">Hybrid</option>
                                    <option value="electric" class="bg-slate-900 text-white">Electric</option>
                                </select>
                                <span class="pointer-events-none absolute right-5 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-slate-500 font-bold ml-1 tracking-widest">Prima inregistrare</label>
                            <input v-model="formData.vehicleFirstRegistration" type="date" required style="color-scheme: dark;" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-slate-500 font-bold ml-1 tracking-widest">Tip Uz</label>
                            <div class="relative">
                                <select v-model="formData.vehicleUsageType" required class="w-full appearance-none rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 cursor-pointer transition-all">
                                    <option value="" disabled selected class="bg-slate-900 text-slate-400">Alege...</option>
                                    <option value="personal" class="bg-slate-900 text-white">Personal</option>
                                </select>
                                <span class="pointer-events-none absolute right-5 top-1/2 -translate-y-1/2 text-green-500 text-xs">▼</span>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-slate-500 font-bold ml-1 tracking-widest">Serie CIV</label>
                            <input v-model="formData.vehicleCIV" placeholder="Ex: X123456" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                        </div>
                    </div>

                    <div class="mb-8 flex w-full gap-6">
                        <div class="mb-8 w-1/2">
                            <label class="text-[10px] uppercase text-slate-500 font-bold ml-1 tracking-widest">Kilometraj</label>
                            <input v-model="formData.vehicleCurrentMileage" type="number" placeholder="Km" required class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white outline-none focus:border-green-500/50 transition-all" />
                        </div>

                        <div class="mb-8 w-1/2">
                            <label class="text-xs font-bold uppercase text-slate-500 ml-1 tracking-widest">Data expirarii ITP</label>
                            <input v-model="formData.vehicleExpirationDatePti" type="date" required style="color-scheme: dark;" class="w-full rounded-2xl bg-slate-950/40 border border-slate-700/50 px-5 py-4 text-white focus:border-green-500 outline-none transition-all" />
                        </div>
                    </div>

                    <label class="mb-12 flex items-center gap-4 bg-slate-950/40 p-5 rounded-2xl border border-slate-800 cursor-pointer hover:bg-slate-950/60 transition-all">
                        <input v-model="formData.isAcquiredFromRomanianDealer" type="checkbox" required class="h-6 w-6 rounded border-slate-700 bg-slate-800 text-green-500 focus:ring-green-500 accent-green-600 shadow-sm" />
                        <span class="text-sm font-medium text-slate-300">Vehicul achiziționat de la dealer român</span>
                    </label>

                    <div class="pt-8">
                        <button type="submit" class="relative group w-full overflow-hidden rounded-2xl bg-green-500 px-8 py-6 text-xl font-black text-slate-950 transition-all hover:bg-green-400 hover:scale-[1.01] active:scale-[0.98] shadow-[0_0_50px_rgba(34,197,94,0.3)]">
                            <div class="relative z-10 flex items-center justify-center gap-3">
                                <span>OBȚINE OFERTE</span>
                                <svg class="w-7 h-7 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </main>

        <Snackbar
            :visible="snackbarVisible"
            :text="snackbarText"
            :duration="5000"
            @close="snackbarVisible = false"
        />
    </div>
</template>

<style scoped>

</style>
