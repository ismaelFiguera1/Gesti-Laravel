<?php

use App\Http\Controllers\Companies\ContactesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UsuariController;

Route::get('/', function () {
    return redirect()->route('clients.index');
});

Route::get('/contact/company',[ContactesController::class,'VistaContactes'])->name('contactes');
Route::get('/contact/company/afegir',[ContactesController::class,'afegirContacte'])->name('contactes.afegir');

// Rutes específiques per a clients
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::post('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

// Rutes específiques per a usuaris
Route::get('/usuaris', [UsuariController::class, 'index'])->name('usuaris.index');
Route::get('/usuaris/create', [UsuariController::class, 'create'])->name('usuaris.create');
Route::post('/usuaris', [UsuariController::class, 'store'])->name('usuaris.store');
Route::get('/usuaris/{usuari}/edit', [UsuariController::class, 'edit'])->name('usuaris.edit');
Route::put('/usuaris/{usuari}', [UsuariController::class, 'update'])->name('usuaris.update');
Route::post('/usuaris/{usuari}', [UsuariController::class, 'destroy'])->name('usuaris.destroy');
