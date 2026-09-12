<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::middleware('role:admin,tecnico,cliente')->group(function () {
        Route::resource('equipamentos', EquipamentoController::class)
            ->parameters(['equipamentos' => 'equipamento']);

        Route::resource('ordens', OrdemServicoController::class)
            ->parameters(['ordens' => 'ordem']);

        Route::post('/ordens/{ordem}/pecas', [PecaController::class, 'store'])
            ->name('pecas.store');

        Route::delete(
            '/ordens/{ordem}/pecas/{peca}',
            [PecaController::class, 'destroy']
        )->name('pecas.destroy');
    });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::resource('users', UserController::class)
                ->only(['index', 'edit', 'update', 'destroy']);
        });
});

require __DIR__.'/auth.php';