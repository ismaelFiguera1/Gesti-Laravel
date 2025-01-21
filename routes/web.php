<?php

use App\Http\Controllers\Companies\ContactesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact/company',[ContactesController::class,'VistaContactes'])->name('contactes');
Route::get('/contact/company/afegir',[ContactesController::class,'afegirContacte'])->name('contactes.afegir');
