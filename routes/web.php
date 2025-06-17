<?php

use Illuminate\Support\Facades\Route;

// Redirecionar página inicial para login
Route::get('/', function () {
    return redirect('/login');
});

// Página protegida após login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// As rotas de autenticação são carregadas automaticamente pelo Laravel UI
Auth::routes();