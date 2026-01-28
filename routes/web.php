<?php

use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// TODO controllers

// TODO move all custom routes to /api.php

Route::get("/", function () {
    return Inertia::render("Home");
})->name("home.page");

// TODO user auth

Route::get("/login", function () {
    return Inertia::render("Login");
})->name("login.page");

Route::get("/offers", function () {
    return Inertia::render("Offers");
})->name("offers.page");

Route::post('/offers', [OfferController::class, 'index'])->name('offers.index');

Route::get("/offerResults", function() {
    return Inertia::render("OfferResults");
})->name("offerResults.page");

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
