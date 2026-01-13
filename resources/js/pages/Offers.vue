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
                <!-- TODO remove asiguratori care nu merg -->
                <!-- Insurance Provider (provider.organization:) -->
                <label>Asigurator</label>
                <select required>
                    <option value="" hidden>Alege asigurator</option>

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

                <!-- product.motor: -->
                <label>Date asigurare</label>

                <label>Data inceperii</label>
                <input type="date">

                <label>Durata in luni</label>
                <input type="number">

                <label>Numar rate</label>
                <input type="number">
                <!-- product.motor.comissionPercentLimit? 12 -->
                <!-- product.motor.renewPolicy.series? "XX/XX/XX" -->
                <!-- product.motor.renewPolicy.number? 123456789 -->

                <!-- product.generatePaymentLink? false -->
                <!-- product.webhookLink? "https://domain.com/webhook/example" -->

                <!-- Business Details (product.policyholder:) -->
                <label>Date titular</label>

                <label>Persoana juridica</label>
                <input type="checkbox">
                <!-- TODO render field uri firma daca persoana juridica -->
                <input placeholder="Nume firma" type="text">
                <input placeholder="Numar registru firma" type="text">
                <input placeholder="Cod CAEN" type="text">
                <input placeholder="Nume" type="text">
                <input placeholder="Prenume" type="text">

                <label>Persoana straina</label>
                <input type="checkbox">

                <!-- TODO daca e firma atunci CUI, daca e persoana fizica atunci CNP -->
                <input placeholder="Cod Identificare Fiscala" type="text">
<!--                <input placeholder="CNP" type="text">-->

                <label>Naționalitate</label>
                <select>
                    <option value="" hidden>Alege nationalitatea</option>

                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Vatican</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">North Korea</option>
                    <option value="KR">South Korea</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>

                <label>Cetățenie</label>
                <select>
                    <option value="" hidden>Alege cetățenia</option>

                    <option value="AF">Afghan</option>
                    <option value="AL">Albanian</option>
                    <option value="DZ">Algerian</option>
                    <option value="AD">Andorran</option>
                    <option value="AO">Angolan</option>
                    <option value="AR">Argentinian</option>
                    <option value="AM">Armenian</option>
                    <option value="AU">Australian</option>
                    <option value="AT">Austrian</option>
                    <option value="AZ">Azerbaijani</option>
                    <option value="BS">Bahamian</option>
                    <option value="BH">Bahraini</option>
                    <option value="BD">Bangladeshi</option>
                    <option value="BY">Belarusian</option>
                    <option value="BE">Belgian</option>
                    <option value="BO">Bolivian</option>
                    <option value="BA">Bosnian</option>
                    <option value="BR">Brazilian</option>
                    <option value="BG">Bulgarian</option>
                    <option value="CA">Canadian</option>
                    <option value="CL">Chilean</option>
                    <option value="CN">Chinese</option>
                    <option value="CO">Colombian</option>
                    <option value="HR">Croatian</option>
                    <option value="CU">Cuban</option>
                    <option value="CY">Cypriot</option>
                    <option value="CZ">Czech</option>
                    <option value="DK">Danish</option>
                    <option value="EG">Egyptian</option>
                    <option value="EE">Estonian</option>
                    <option value="FI">Finnish</option>
                    <option value="FR">French</option>
                    <option value="DE">German</option>
                    <option value="GR">Greek</option>
                    <option value="HU">Hungarian</option>
                    <option value="IS">Icelandic</option>
                    <option value="IN">Indian</option>
                    <option value="ID">Indonesian</option>
                    <option value="IR">Iranian</option>
                    <option value="IE">Irish</option>
                    <option value="IL">Israeli</option>
                    <option value="IT">Italian</option>
                    <option value="JP">Japanese</option>
                    <option value="KR">South Korean</option>
                    <option value="LV">Latvian</option>
                    <option value="LT">Lithuanian</option>
                    <option value="LU">Luxembourgish</option>
                    <option value="MD">Moldovan</option>
                    <option value="MX">Mexican</option>
                    <option value="NL">Dutch</option>
                    <option value="NO">Norwegian</option>
                    <option value="PL">Polish</option>
                    <option value="PT">Portuguese</option>
                    <option value="RO">Romanian</option>
                    <option value="RU">Russian</option>
                    <option value="RS">Serbian</option>
                    <option value="SK">Slovak</option>
                    <option value="SI">Slovenian</option>
                    <option value="ES">Spanish</option>
                    <option value="SE">Swedish</option>
                    <option value="CH">Swiss</option>
                    <option value="TR">Turkish</option>
                    <option value="UA">Ukrainian</option>
                    <option value="GB">British</option>
                    <option value="US">American</option>
                </select>

                <label>Sex</label>
                <select>
                    <option value="" hidden>Sex</option>

                    <option value="m">Masculin</option>
                    <option value="f">Feminin</option>
                </select>

                <label>Data nasterii</label>
                <input type="date">

                <input placeholder="Email" type="email">
                <input placeholder="Telefon" type="text">

                <label>Act de identitate</label>
                <select>
                    <option value="" hidden>Alege actul de identitate</option>

                    <option value="CI">Buletin</option>
                </select>

                <!-- product.policyholder.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Eliberat de" type="text">

                <label>Eliberat la data de</label>
                <input type="date">

                <!-- Driving License (product.policyholder.drivingLicense:) -->
                <label>Permis de conducere</label>
                <label>Eliberat la data de</label>
                <input type="date">

                <!-- TODO doar Romania? -->
                <!-- Address (product.policyholder.address:) -->
                <label>Adresa</label>
                <label>Tara</label>
                <select>
                    <option value="" hidden>Alege tara</option>

                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Vatican</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">North Korea</option>
                    <option value="KR">South Korea</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>

                <label>Județ</label>
                <select>
                    <option value="" hidden>Alege județ</option>

                    <option value="AB">Alba</option>
                    <option value="AR">Arad</option>
                    <option value="AG">Argeș</option>
                    <option value="BC">Bacău</option>
                    <option value="BH">Bihor</option>
                    <option value="BN">Bistrița-Năsăud</option>
                    <option value="BT">Botoșani</option>
                    <option value="BR">Brăila</option>
                    <option value="BV">Brașov</option>
                    <option value="BZ">Buzău</option>
                    <option value="CL">Călărași</option>
                    <option value="CS">Caraș-Severin</option>
                    <option value="CJ">Cluj</option>
                    <option value="CT">Constanța</option>
                    <option value="CV">Covasna</option>
                    <option value="DB">Dâmbovița</option>
                    <option value="DJ">Dolj</option>
                    <option value="GL">Galați</option>
                    <option value="GR">Giurgiu</option>
                    <option value="GJ">Gorj</option>
                    <option value="HR">Harghita</option>
                    <option value="HD">Hunedoara</option>
                    <option value="IL">Ialomița</option>
                    <option value="IS">Iași</option>
                    <option value="IF">Ilfov</option>
                    <option value="MM">Maramureș</option>
                    <option value="MH">Mehedinți</option>
                    <option value="MS">Mureș</option>
                    <option value="NT">Neamț</option>
                    <option value="OT">Olt</option>
                    <option value="PH">Prahova</option>
                    <option value="SM">Satu Mare</option>
                    <option value="SJ">Sălaj</option>
                    <option value="SB">Sibiu</option>
                    <option value="SV">Suceava</option>
                    <option value="TR">Teleorman</option>
                    <option value="TM">Timiș</option>
                    <option value="TL">Tulcea</option>
                    <option value="VL">Vâlcea</option>
                    <option value="VS">Vaslui</option>
                    <option value="VN">Vrancea</option>
                    <option value="B">București</option>
                </select>

                <!-- TODO select oras by county -->
                <label>Oras</label>
                <input type="text">

                <!-- TODO codul SIRUTA este procesat in backend -->
<!--                <input placeholder="Cod SIRUTA">-->
                <input placeholder="Strada" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Bloc" type="text">
                <input placeholder="Scara" type="text">
                <input placeholder="Apartament" type="text">
                <input placeholder="Etaj" type="text">
                <input placeholder="Cod postal" type="text">

                <label>Dizabilitati</label>
                <input type="checkbox">

                <label>Pensionar</label>
                <input type="checkbox">

                <!-- Vehicle Info (product.vehicle.owner:) -->
                <label>Date proprietar vehicul</label>

                <label>Persoana juridica</label>
                <input type="checkbox"/>

                <!-- TODO daca e persoana juridica arata field urile pentru firma -->
                <input placeholder="Companie" type="text">
                <input placeholder="Cod registru" type="text">
                <input placeholder="Cod CAEN" type="text">

                <input placeholder="Nume" type="text">
                <input placeholder="Prenume" type="text">

                <label>Persoana straina</label>
                <input type="checkbox">

                <!-- TODO daca e persoana juridica CIF, daca e persoana fizica CNP -->
                <input placeholder="Cod Identificare Fiscala">
<!--                <input placeholder="CNP"/>-->

                <label>Naționalitate</label>
                <select>
                    <option value="" hidden>Alege nationalitatea</option>

                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Vatican</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">North Korea</option>
                    <option value="KR">South Korea</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>

                <label>Cetățenie</label>
                <select>
                    <option value="" hidden>Alege cetățenia</option>

                    <option value="AF">Afghan</option>
                    <option value="AL">Albanian</option>
                    <option value="DZ">Algerian</option>
                    <option value="AD">Andorran</option>
                    <option value="AO">Angolan</option>
                    <option value="AR">Argentinian</option>
                    <option value="AM">Armenian</option>
                    <option value="AU">Australian</option>
                    <option value="AT">Austrian</option>
                    <option value="AZ">Azerbaijani</option>
                    <option value="BS">Bahamian</option>
                    <option value="BH">Bahraini</option>
                    <option value="BD">Bangladeshi</option>
                    <option value="BY">Belarusian</option>
                    <option value="BE">Belgian</option>
                    <option value="BO">Bolivian</option>
                    <option value="BA">Bosnian</option>
                    <option value="BR">Brazilian</option>
                    <option value="BG">Bulgarian</option>
                    <option value="CA">Canadian</option>
                    <option value="CL">Chilean</option>
                    <option value="CN">Chinese</option>
                    <option value="CO">Colombian</option>
                    <option value="HR">Croatian</option>
                    <option value="CU">Cuban</option>
                    <option value="CY">Cypriot</option>
                    <option value="CZ">Czech</option>
                    <option value="DK">Danish</option>
                    <option value="EG">Egyptian</option>
                    <option value="EE">Estonian</option>
                    <option value="FI">Finnish</option>
                    <option value="FR">French</option>
                    <option value="DE">German</option>
                    <option value="GR">Greek</option>
                    <option value="HU">Hungarian</option>
                    <option value="IS">Icelandic</option>
                    <option value="IN">Indian</option>
                    <option value="ID">Indonesian</option>
                    <option value="IR">Iranian</option>
                    <option value="IE">Irish</option>
                    <option value="IL">Israeli</option>
                    <option value="IT">Italian</option>
                    <option value="JP">Japanese</option>
                    <option value="KR">South Korean</option>
                    <option value="LV">Latvian</option>
                    <option value="LT">Lithuanian</option>
                    <option value="LU">Luxembourgish</option>
                    <option value="MD">Moldovan</option>
                    <option value="MX">Mexican</option>
                    <option value="NL">Dutch</option>
                    <option value="NO">Norwegian</option>
                    <option value="PL">Polish</option>
                    <option value="PT">Portuguese</option>
                    <option value="RO">Romanian</option>
                    <option value="RU">Russian</option>
                    <option value="RS">Serbian</option>
                    <option value="SK">Slovak</option>
                    <option value="SI">Slovenian</option>
                    <option value="ES">Spanish</option>
                    <option value="SE">Swedish</option>
                    <option value="CH">Swiss</option>
                    <option value="TR">Turkish</option>
                    <option value="UA">Ukrainian</option>
                    <option value="GB">British</option>
                    <option value="US">American</option>
                </select>

                <label>Sex</label>
                <select>
                    <option value="" hidden>Sex</option>

                    <option value="m">Masculin</option>
                    <option value="f">Feminin</option>
                </select>

                <label>Data nasterii</label>
                <input type="date">

                <input placeholder="Email" type="email">
                <input placeholder="Telefon" type="text">

                <label>Act de identitate</label>
                <select>
                    <option value="" hidden>Alege actul de identitate</option>

                    <option value="CI">Buletin</option>
                </select>

                <!-- product.policyholder.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie" type="text">
                <input placeholder="Numar" type="text">

                <!-- Driving License (product.vehicle.owner.drivingLicense:) -->
                <label>Permis de conducere</label>
                <label>Eliberat la data de</label>
                <input type="date">

                <!-- Address (product.vehicle.owner.address:) -->
                <label>Adresa</label>
                <label>Tara</label>
                <select>
                    <option value="" hidden>Alege tara</option>

                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Vatican</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">North Korea</option>
                    <option value="KR">South Korea</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>

                <label>Județ</label>
                <select>
                    <option value="" hidden>Alege județ</option>

                    <option value="AB">Alba</option>
                    <option value="AR">Arad</option>
                    <option value="AG">Argeș</option>
                    <option value="BC">Bacău</option>
                    <option value="BH">Bihor</option>
                    <option value="BN">Bistrița-Năsăud</option>
                    <option value="BT">Botoșani</option>
                    <option value="BR">Brăila</option>
                    <option value="BV">Brașov</option>
                    <option value="BZ">Buzău</option>
                    <option value="CL">Călărași</option>
                    <option value="CS">Caraș-Severin</option>
                    <option value="CJ">Cluj</option>
                    <option value="CT">Constanța</option>
                    <option value="CV">Covasna</option>
                    <option value="DB">Dâmbovița</option>
                    <option value="DJ">Dolj</option>
                    <option value="GL">Galați</option>
                    <option value="GR">Giurgiu</option>
                    <option value="GJ">Gorj</option>
                    <option value="HR">Harghita</option>
                    <option value="HD">Hunedoara</option>
                    <option value="IL">Ialomița</option>
                    <option value="IS">Iași</option>
                    <option value="IF">Ilfov</option>
                    <option value="MM">Maramureș</option>
                    <option value="MH">Mehedinți</option>
                    <option value="MS">Mureș</option>
                    <option value="NT">Neamț</option>
                    <option value="OT">Olt</option>
                    <option value="PH">Prahova</option>
                    <option value="SM">Satu Mare</option>
                    <option value="SJ">Sălaj</option>
                    <option value="SB">Sibiu</option>
                    <option value="SV">Suceava</option>
                    <option value="TR">Teleorman</option>
                    <option value="TM">Timiș</option>
                    <option value="TL">Tulcea</option>
                    <option value="VL">Vâlcea</option>
                    <option value="VS">Vaslui</option>
                    <option value="VN">Vrancea</option>
                    <option value="B">București</option>
                </select>

                <!-- TODO select oras by county -->
                <label>Oras</label>
                <input type="text">

                <!-- TODO codul SIRUTA este procesat in backend -->
                <!--                <input placeholder="Cod SIRUTA">-->
                <input placeholder="Strada" type="text">
                <input placeholder="Numar" type="text">
                <input placeholder="Bloc" type="text">
                <input placeholder="Scara" type="text">
                <input placeholder="Apartament" type="text">
                <input placeholder="Etaj" type="text">
                <input placeholder="Cod postal" type="text">

                <label>Dizabilitati</label>
                <input type="checkbox">

                <label>Pensionar</label>
                <input type="checkbox">

                <!-- TODO user ul poate adauga mai multi soferi -->
                <!-- Driver (product.vehicle.driver:) (lista de persoane care conduc masina) -->
                <label>Date soferi</label>
                <input placeholder="Nume">
                <input placeholder="Prenume">
                <input placeholder="CNP">
                <!-- product.vehicle.driver.identification.idNumber: (serie + numar) -->
                <input placeholder="Serie">
                <input placeholder="Numar">
                <input placeholder="Telefon">

                <!-- Car (product.vehicle:) -->
                <label>Date vehicul</label>
                <input placeholder="Numar inmatriculare">

                <label>Tip inregistrare</label>
                <select>
                    <option value="" hidden>Alege tip inregistrare</option>

                    <option value="registered">Inregistrat</option>
                    <option value="unregistered">Neinregistrat</option>
                </select>

                <input placeholder="VIN">

                <label>Tip vehicul</label>
                <select>
                    <option value="" hidden>Alege tipul vehiculului</option>

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

                <input placeholder="Marca">
                <input placeholder="Model">
                <input placeholder="An fabricatie" type="number">
                <input placeholder="Capacitate motor" type="number">
                <input placeholder="Putere motor" type="number">
                <input placeholder="Greutate" type="number">
                <input placeholder="Locuri" type="number">

                <label>Combustibil</label>
                <select>
                    <option value="" hidden>Alege tipul combustibilului</option>

                    <option value="diesel">Diesel</option>
                    <option value="petrol">Benzină</option>
                    <option value="hybrid">Hybrid</option>
                    <option value="electric">Electric</option>
                </select>

                <label>Prima inregistrare</label>
                <input type="date"/>

                <label>Tip uz</label>
                <select>
                    <option value="" hidden>Alege tip uz</option>

                    <option value="personal">Personal</option>
                </select>

                <input placeholder="CIV">
                <input placeholder="Kilometraj" type="number">

                <label>Modificari</label>
                <input type="checkbox"/>

                <label>Leased</label>
                <input type="checkbox"/>

                <label>Vehicul Nou</label>
                <input type="checkbox"/>

                <!-- product.additionalData.product.motor: -->
                <label>Vehiculul are Casco</label>
                <input type="checkbox"/>

                <label>Extra coverage</label>
                <input type="checkbox"/>

                <label>Vehicul achizitionat de la dealer roman</label>
                <input type="checkbox"/>

                <!-- product.additionalData.coordinatorId? NOPE -->
                <!-- product.additionalData.recommenderTaxId? NOPE -->
                <!-- product.additionalData.protocolId? NOPE -->

                <button type="submit" @click="handleGetOffers">Get Offers</button>
            </form>
        </main>
        <footer>
        </footer>
    </body>
</template>

<style scoped>

</style>
