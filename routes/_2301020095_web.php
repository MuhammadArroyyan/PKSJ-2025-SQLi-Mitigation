<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\_2301020109_AuthController;
use App\Http\Controllers\_2301020109_AdminController;
use App\Http\Controllers\_2301020074_KaprodiController;
use App\Http\Controllers\_2301020074_MahasiswaController;
use App\Http\Controllers\_2301020074_PimpinanController;
use App\Http\Controllers\_2301020095_ProfileController;

Route::get('/', function () {
    if (Auth::check()) {
        // Redirect ke dashboard sesuai role
        return match(Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'kaprodi' => redirect()->route('kaprodi.dashboard'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            'pimpinan' => redirect()->route('pimpinan.dashboard'),
            default => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [_2301020109_AuthController::class, 'login'])->name('login');
Route::post('/login', [_2301020109_AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [_2301020109_AuthController::class, 'logout'])->name('logout');

// Profile Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile/change-password', [_2301020095_ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/update-password', [_2301020095_ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [_2301020109_AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [_2301020109_AdminController::class, 'indexUser'])->name('users.index');
    Route::post('/users', [_2301020109_AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/create', [_2301020109_AdminController::class, 'createUser'])->name('users.create');
    Route::get('/users/{user}/edit', [_2301020109_AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [_2301020109_AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [_2301020109_AdminController::class, 'destroyUser'])->name('users.destroy');

    // Fakultas Management
    Route::get('/fakultas', [_2301020109_AdminController::class, 'indexFakultas'])->name('fakultas.index');
    Route::post('/fakultas', [_2301020109_AdminController::class, 'storeFakultas'])->name('fakultas.store');
    Route::get('/fakultas/create', [_2301020109_AdminController::class, 'createFakultas'])->name('fakultas.create');
    Route::get('/fakultas/{fakultas}/edit', [_2301020109_AdminController::class, 'editFakultas'])->name('fakultas.edit');
    Route::put('/fakultas/{fakultas}', [_2301020109_AdminController::class, 'updateFakultas'])->name('fakultas.update');
    Route::delete('/fakultas/{fakultas}', [_2301020109_AdminController::class, 'destroyFakultas'])->name('fakultas.destroy');

    // Jurusan Management
    Route::get('/jurusan', [_2301020109_AdminController::class, 'indexJurusan'])->name('jurusan.index');
    Route::post('/jurusan', [_2301020109_AdminController::class, 'storeJurusan'])->name('jurusan.store');
    Route::get('/jurusan/create', [_2301020109_AdminController::class, 'createJurusan'])->name('jurusan.create');
    Route::get('/jurusan/{jurusan}/edit', [_2301020109_AdminController::class, 'editJurusan'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [_2301020109_AdminController::class, 'updateJurusan'])->name('jurusan.update');
    Route::delete('/jurusan/{jurusan}', [_2301020109_AdminController::class, 'destroyJurusan'])->name('jurusan.destroy');

    // Prodi Management
    Route::get('/prodi', [_2301020109_AdminController::class, 'indexProdi'])->name('prodi.index');
    Route::post('/prodi', [_2301020109_AdminController::class, 'storeProdi'])->name('prodi.store');
    Route::get('/prodi/create', [_2301020109_AdminController::class, 'createProdi'])->name('prodi.create');
    Route::get('/prodi/{prodi}/edit', [_2301020109_AdminController::class, 'editProdi'])->name('prodi.edit');
    Route::put('/prodi/{prodi}', [_2301020109_AdminController::class, 'updateProdi'])->name('prodi.update');
    Route::delete('/prodi/{prodi}', [_2301020109_AdminController::class, 'destroyProdi'])->name('prodi.destroy');

    // Mahasiswa Management
    Route::get('/mahasiswa', [_2301020109_AdminController::class, 'indexMahasiswa'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [_2301020109_AdminController::class, 'storeMahasiswa'])->name('mahasiswa.store');
    Route::get('/mahasiswa/create', [_2301020109_AdminController::class, 'createMahasiswa'])->name('mahasiswa.create');
    Route::get('/mahasiswa/{mahasiswa}/edit', [_2301020109_AdminController::class, 'editMahasiswa'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{mahasiswa}', [_2301020109_AdminController::class, 'updateMahasiswa'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [_2301020109_AdminController::class, 'destroyMahasiswa'])->name('mahasiswa.destroy');
});

// Kaprodi Routes
Route::middleware(['auth', 'role:kaprodi'])->prefix('kaprodi')->name('kaprodi.')->group(function () {
    Route::get('/dashboard', [_2301020074_KaprodiController::class, 'dashboard'])->name('dashboard');

    // Periode Kuisioner
    Route::get('/periode', [_2301020074_KaprodiController::class, 'indexPeriode'])->name('periode.index');
    Route::post('/periode', [_2301020074_KaprodiController::class, 'storePeriode'])->name('periode.store');
    Route::get('/periode/create', [_2301020074_KaprodiController::class, 'createPeriode'])->name('periode.create');
    Route::get('/periode/{periode}/edit', [_2301020074_KaprodiController::class, 'editPeriode'])->name('periode.edit');
    Route::put('/periode/{periode}', [_2301020074_KaprodiController::class, 'updatePeriode'])->name('periode.update');
    Route::delete('/periode/{periode}', [_2301020074_KaprodiController::class, 'destroyPeriode'])->name('periode.destroy');

    // Pertanyaan
    Route::get('/pertanyaan', [_2301020074_KaprodiController::class, 'indexPertanyaan'])->name('pertanyaan.index');
    Route::post('/pertanyaan', [_2301020074_KaprodiController::class, 'storePertanyaan'])->name('pertanyaan.store');
    Route::get('/pertanyaan/create', [_2301020074_KaprodiController::class, 'createPertanyaan'])->name('pertanyaan.create');
    Route::get('/pertanyaan/{pertanyaan}/edit', [_2301020074_KaprodiController::class, 'editPertanyaan'])->name('pertanyaan.edit');
    Route::put('/pertanyaan/{pertanyaan}', [_2301020074_KaprodiController::class, 'updatePertanyaan'])->name('pertanyaan.update');
    Route::delete('/pertanyaan/{pertanyaan}', [_2301020074_KaprodiController::class, 'destroyPertanyaan'])->name('pertanyaan.destroy');

    // Summary
    Route::get('/summary', [_2301020074_KaprodiController::class, 'summarySummary'])->name('summary.index');
    Route::get('/summary/{id_periode}', [_2301020074_KaprodiController::class, 'getSummaryData'])->name('summary.detail');

    // Jawaban Mahasiswa
    Route::get('/jawaban', [_2301020074_KaprodiController::class, 'indexJawaban'])->name('jawaban.index');

    // Add pertanyaan to periode
    Route::post('/pertanyaan-periode', [_2301020074_KaprodiController::class, 'addPertanyaanToPeriode'])->name('pertanyaan-periode.store');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [_2301020074_MahasiswaController::class, 'dashboard'])->name('dashboard');

    // Kuisioner
    Route::get('/kuisioner', [_2301020074_MahasiswaController::class, 'listKuisioner'])->name('kuisioner.list');
    Route::get('/kuisioner/{id_periode}', [_2301020074_MahasiswaController::class, 'showKuisioner'])->name('kuisioner.show');
    Route::post('/kuisioner/{id_periode}', [_2301020074_MahasiswaController::class, 'storeJawaban'])->name('kuisioner.store');
    Route::get('/kuisioner/{id_periode}/edit', [_2301020074_MahasiswaController::class, 'editKuisioner'])->name('kuisioner.edit');
});

// Pimpinan Routes
Route::middleware(['auth', 'role:pimpinan'])->prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/dashboard', [_2301020074_PimpinanController::class, 'dashboard'])->name('dashboard');

    // Summary
    Route::get('/summary', [_2301020074_PimpinanController::class, 'summary'])->name('summary.index');
    Route::get('/summary/detail', [_2301020074_PimpinanController::class, 'getSummaryData'])->name('summary.detail');
});
