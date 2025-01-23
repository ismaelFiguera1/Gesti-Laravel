<?php

use App\Http\Controllers\Companies\ContactesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('',[ContactesController::class,'VistaContactes'])->name('contactes');
Route::get('/company/company/afegir',[ContactesController::class,'afegirContacte'])->name('contactes.afegir');
Route::post('/company/company/esborrar/{id}',[ContactesController::class,'esborrarContacte'])->name('contacte.esborrar');
Route::get('/company/company/editar/{id}',[ContactesController::class,'actualitzarContacte'])->name('contacte.actualitzar');
Route::post('/company/company/vincularContactPrimary/{id}',[ContactesController::class,'VincularContacte'])->name('contacte.vincular');

