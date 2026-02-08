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

Route::get("/offers/{id}", [OfferController::class, "downloadOffer"])->name('offers.download');

// TODO how to assign a general route to a controller and define custom routes inside it?

Route::get("/offerResults", function() {
    // TODO this is flash data, store offers permanently in session in OfferController
    $offers = session("offers");
    return Inertia::render("OfferResults", ["offers" => $offers]);
})->name("offerResults.page");

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
