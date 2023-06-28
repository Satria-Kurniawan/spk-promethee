<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\NilaiFlowController;
use App\Http\Controllers\NilaiPreferensiController;
use App\Http\Controllers\PerankinganController;
use App\Http\Controllers\PreferensiMultiKriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/data-atlet/tambah', [AthleteController::class, 'tambahAtlet'])->name('atlet.add');
    Route::post('/data-atlet/update/{id}', [AthleteController::class, 'perbaruiAtlet'])->name('atlet.update');
    Route::get('/data-atlet/delete/{id}', [AthleteController::class, 'hapusAtlet'])->name('atlet.delete');
    Route::get('/data-atlet', [AthleteController::class, 'getDataAtlet'])->name('data-atlet');
    Route::get('/nilai-preferensi-kriteria', [NilaiPreferensiController::class, 'nilaiPreferensiKriteria'])->name('nilai-preferensi-kriteria');
    Route::get('/nilai-preferensi-multikriteria', [PreferensiMultiKriteriaController::class, 'nilaiPreferensiMultiKriteria'])->name('nilai-preferensi-multikriteria');
    Route::get('/nilai-flow', [NilaiFlowController::class, 'nilaiFlow'])->name('nilai-flow');
    Route::get('/perankingan', [PerankinganController::class, 'perankingan'])->name('perankingan');
});

require __DIR__.'/auth.php';
