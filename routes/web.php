<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\AdminPengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifiedUser;
use Illuminate\Support\Facades\Auth;

// Halaman Utama
Route::get('/', fn() => view('welcome'));

// Auto redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'user' => redirect()->route('users.pengaduan.index'),
        default => abort(403),
    };
})->middleware('auth')->name('dashboard');


// Route Users
Route::middleware(['auth', 'is_user', VerifiedUser::class])
    ->prefix('dashboard/users')
    ->name('users.')
    ->group(function () {
        Route::get('/', fn() => view('users.dashboard'))->name('dashboard');
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    });

// Route Admin
Route::middleware(['auth', 'is_admin', VerifiedUser::class])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

        // Kelola Pengaduan
        Route::resource('/pengaduan', AdminPengaduanController::class)
            ->only(['index', 'show', 'update']);

        // Verifikasi User
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
        Route::put('/users/{user}/unverify', [UserController::class, 'unverify'])->name('users.unverify');
    });


// Route untuk Profile (boleh tanpa verifikasi is_verified)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include route auth bawaan Breeze
require __DIR__ . '/auth.php';
