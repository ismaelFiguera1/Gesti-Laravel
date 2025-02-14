<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Companies\ContactesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UsuariController;
use Illuminate\Support\Facades\Auth;




Route::get('/', function () {
    return view('home');
});



Route::get('/dashboard', function () {
    return view('dashboard_aplicacio');
})->middleware(['auth', 'verified'])->name('dashboard');






Route::get('/dashboardqw', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Clients

Route::get('/clients/search-form', [ClientController::class, 'searchForm'])->name('clients.searchForm');

Route::middleware('auth')->group(function () {
    Route::resource('/clients', ClientController::class);
});











Route::get('/contact/company',[ContactesController::class,'VistaContactes'])->name('contactes');
Route::get('/contact/company/afegir',[ContactesController::class,'afegirContacte'])->name('contactes.afegir');



// Rutes específiques per a usuaris
Route::get('/usuaris', [UsuariController::class, 'index'])->name('usuaris.index');
Route::get('/usuaris/create', [UsuariController::class, 'create'])->name('usuaris.create');
Route::post('/usuaris', [UsuariController::class, 'store'])->name('usuaris.store');
Route::get('/usuaris/{usuari}/edit', [UsuariController::class, 'edit'])->name('usuaris.edit');
Route::put('/usuaris/{usuari}', [UsuariController::class, 'update'])->name('usuaris.update');
Route::post('/usuaris/{usuari}', [UsuariController::class, 'destroy'])->name('usuaris.destroy');


Route::get('/company/company/afegir',[ContactesController::class,'afegirContacte'])->name('contactes.afegir');
Route::post('/company/company/esborrar/{id}',[ContactesController::class,'esborrarContacte'])->name('contacte.esborrar');
Route::get('/company/company/editar/{id}',[ContactesController::class,'actualitzarContacte'])->name('contacte.actualitzar');
Route::post('/company/company/vincularContactPrimary/{id}',[ContactesController::class,'VincularContacte'])->name('contacte.vincular');





require __DIR__.'/auth.php';