<script setup lang="ts">

import { router } from '@inertiajs/vue3';

const handleGetOffers = () => {
    router.post("/offers");
}

</script>

<template>
    <body>
        <header>
        </header>
        <main>
            <form
                @submit.prevent="handleGetOffers"
                class="flex flex-col"
            >
                <!-- Insurance Provider (provider.organization:) -->
                <input placeholder="Asigurator">

                <!-- product.motor: -->
                <div>Date asigurare</div>
                <input placeholder="Data inceperii">
                <input placeholder="Durata in luni">
                <input placeholder="Numar rate">
                <!-- product.motor.comissionPercentLimit? -->
                <!-- product.motor.renewPolicy.series? -->
                <!-- product.motor.renewPolicy.number? -->

                <!-- product.generatePaymentLink? -->
                <!-- product.webhookLink? -->

                <!-- Business Details (product.policyholder:) -->
                <div>Date titular</div>
                <input placeholder="Nume firma">
                <input placeholder="Numar registru firma">
                <input placeholder="Cod CAEN">
                <input placeholder="Nume familie">
                <input placeholder="Prenume">
                <input placeholder="Persoana din afara">
                <input placeholder="CUI">
                <input placeholder="Nationalitate">
                <input placeholder="Cetatenie">
                <input placeholder="Sex">
                <input placeholder="Data nastere">
                <input placeholder="Email">
                <input placeholder="Telefon">

                <input placeholder="Tip identificare">
                <!-- product.policyholder.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie">
                <input placeholder="Numar">
                <input placeholder="Eliberat de">
                <input placeholder="Eliberat la data de">

                <!-- Driving License (product.policyholder.drivingLicense:) -->
                <input placeholder="Eliberat la data de">

                <!-- Address (product.policyholder.address:) -->
                <div>Adresa</div>
                <input placeholder="Tara">
                <input placeholder="Judet">
                <input placeholder="Oras">
                <input placeholder="Cod SIRUTA">
                <input placeholder="Strada">
                <input placeholder="Numar">
                <input placeholder="Bloc">
                <input placeholder="Scara">
                <input placeholder="Apartament">
                <input placeholder="Etaj">
                <input placeholder="Cod postal">

                <input placeholder="Dizabilitati">
                <input placeholder="Pensionat">

                <!-- Vehicle Info (product.vehicle.owner:) -->
                <div>Date proprietar vehicul</div>
                <input placeholder="Companie">
                <input placeholder="Cod registru">
                <input placeholder="Cod CAEN">
                <input placeholder="Nume familie">
                <input placeholder="Prenume">
                <input placeholder="Persoana straina">
                <input placeholder="CUI">
                <input placeholder="Nationalitate">
                <input placeholder="Cetatenie">
                <input placeholder="Sex">
                <input placeholder="Data nasterii">
                <input placeholder="Email">
                <input placeholder="Telefon">
                <input placeholder="Tip identificare">
                <!-- product.vehicle.owner.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie">
                <input placeholder="Numar">

                <!-- Driving License (product.vehicle.owner.drivingLicense:) -->
                <input placeholder="Eliberat la data de">

                <!-- Address (product.vehicle.owner.address:) -->
                <div>Adresa</div>
                <input placeholder="Tara">
                <input placeholder="Judet">
                <input placeholder="Oras">
                <input placeholder="Cod SIRUTA">
                <input placeholder="Strada">
                <input placeholder="Numar">
                <input placeholder="Bloc">
                <input placeholder="Scara">
                <input placeholder="Apartament">
                <input placeholder="Etaj">
                <input placeholder="Cod postal">

                <input placeholder="Dizabilitati">
                <input placeholder="Pensionat">

                <!-- Driver (product.vehicle.driver:) (lista de persoane care conduc masina) -->
                <div>Date soferi</div>
                <input placeholder="Nume de familie">
                <input placeholder="Prenume">
                <input placeholder="CNP">
                <!-- product.vehicle.driver.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie">
                <input placeholder="Numar">
                <input placeholder="Telefon">

                <!-- Car (product.vehicle:) -->
                <div>Date vehicul</div>
                <input placeholder="Numar inmatriculare">
                <input placeholder="Inregistrat">
                <input placeholder="VIN">
                <input placeholder="Tip vehicul">
                <input placeholder="Marca">
                <input placeholder="Model">
                <input placeholder="An fabricatie">
                <input placeholder="Capacitate motor">
                <input placeholder="Putere motor">
                <input placeholder="Greutate">
                <input placeholder="Locuri">
                <input placeholder="Combustibil">
                <input placeholder="Prima inregistrare">
                <input placeholder="Uz">
                <input placeholder="CIV">
                <input placeholder="Kilometraj">
                <input placeholder="Modificari">
                <input placeholder="Leased">
                <input placeholder="Noua">

                <!-- product.additionalData.product.motor: -->
                <input placeholder="Casco">

                <!-- product.additionalData.coordinatorId? -->
                <!-- product.additionalData.recommenderTaxId? -->
                <!-- product.additionalData.protocolId? -->
                <!-- product.additionalData.extraCoverage? -->
                <!-- product.additionalData.isAcquiredFromRomanianDealer? -->

                <button type="submit" @click="handleGetOffers">Get Offers</button>
            </form>
        </main>
        <footer>
        </footer>
    </body>
</template>

<style scoped>

</style>
