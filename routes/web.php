<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\TiersController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\ComptabiliteController;
use App\Http\Controllers\FactureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modules ERP - Stocks & Tiers
    Route::resource('categories', CategorieController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('tiers', TiersController::class);
    Route::resource('mouvements', MouvementStockController::class);
    
    // Module Comptabilité SYSCOHADA
    Route::get('/comptabilite', [ComptabiliteController::class, 'journal'])->name('comptabilite.index');
    Route::get('/comptabilite/journal', [ComptabiliteController::class, 'journal'])->name('comptabilite.journal');
    Route::get('/comptabilite/balance', [ComptabiliteController::class, 'balance'])->name('comptabilite.balance');
    Route::get('/comptabilite/create', [ComptabiliteController::class, 'create'])->name('comptabilite.create');
    Route::post('/comptabilite', [ComptabiliteController::class, 'store'])->name('comptabilite.store');
    Route::delete('/comptabilite/{id}', [ComptabiliteController::class, 'destroy'])->name('comptabilite.destroy');

    // Module Facturation et Ventes
    Route::resource('factures', FactureController::class);
});

require __DIR__.'/auth.php';