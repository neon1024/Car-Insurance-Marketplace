<?php

use App\Http\Controllers\NomenclatureController;
use Illuminate\Support\Facades\Route;

// TODO form response to include error, status, message and countries as data

Route::get('/countries', [NomenclatureController::class, "getCountries"])->name("countries.get");

Route::get("/counties", [NomenclatureController::class, "getCounties"])->name("counties.get");

Route::get("/cities/{county_code}", [NomenclatureController::class, "getCitiesByCountyCode"])->name("cities.get");
