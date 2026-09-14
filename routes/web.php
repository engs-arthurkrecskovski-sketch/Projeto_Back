<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Equipamento;
use App\Models\OrdemServico;
use App\Models\User;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

Route::resource('ordens', OrdemServicoController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalEquipamentos' => Equipamento::count(),
        'totalOrdens'       => OrdemServico::count(),
        'totalUsuarios'     => User::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('equipamentos', EquipamentoController::class);
});

require __DIR__.'/auth.php';