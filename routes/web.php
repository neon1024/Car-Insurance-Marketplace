<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// TODO controllers

// TODO move all custom routes to /api.php

Route::get("/", function () {
    return Inertia::render("Home");
})->name("home.page");

Route::get("/login", function () {
    return Inertia::render("Login");
})->name("login.page");

Route::get("/offers", function () {
    return Inertia::render("Offers");
})->name("offers.page");

Route::post('/offers', [OfferController::class, 'index'])->name('offers.index');

Route::get("/offers/{id}", [OfferController::class, "downloadOffer"])->name('offers.download');

Route::get("/offers/{id}/policies", [OfferController::class, "downloadPolicy"])->name("policies.download");

// TODO how to assign a general route to a controller and define custom routes inside it?

Route::get("/offerResults", function() {
    // TODO this is flash data, store offers permanently in session in OfferController
    $offers = session("offers");
    return Inertia::render("OfferResults", ["offers" => $offers]);
})->name("offerResults.page");

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User
Route::get("/user", [UserController::class, "checkIfUserExistsByEmail"])->name("user.check-if-exists-by-email");

Route::post("/user/create", [UserController::class, "createNewUser"])->name("user.create");

Route::post("/user/login", [UserController::class, "loginUser"])->name("user.login");

Route::delete("/user", [UserController::class, "logoutUser"])->name("user.logout");

// dev
Route::get("/dev/user", function() {
    $users = User::all();

    return response()->json($users);
})->name("dev.user.get");

Route::get('/dev/user/delete/{id}', function($id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    session()->forget("user_id");

    return response()->json(['message' => 'User deleted successfully']);
})->name('dev.user.delete.id');

require __DIR__.'/settings.php';
