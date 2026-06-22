<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
    Route::get('/receitas/criar', [ReceitaController::class, 'create'])->name('receitas.create');
    Route::post('/receitas', [ReceitaController::class, 'store'])->name('receitas.store');
    Route::get('/receitas/{receita}/editar', [ReceitaController::class, 'edit'])->name('receitas.edit');
    Route::put('/receitas/{receita}', [ReceitaController::class, 'update'])->name('receitas.update');
    Route::delete('/receitas/{receita}', [ReceitaController::class, 'destroy'])->name('receitas.destroy');
});
