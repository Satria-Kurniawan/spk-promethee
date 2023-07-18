<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\NilaiFlowController;
use App\Http\Controllers\NilaiPreferensiController;
use App\Http\Controllers\PerankinganController;
use App\Http\Controllers\PreferensiMultiKriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubkriteriaController;
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

    Route::get('/data-kriteria', [CriteriaController::class, 'getDataKriteria'])->name('data-kriteria');
    Route::post('/data-kriteria/tambah', [CriteriaController::class, 'tambahKriteria'])->name('kriteria.add');
    Route::post('/data-kriteria/update/{id}', [CriteriaController::class, 'perbaruiKriteria'])->name('kriteria.update');
    Route::get('/data-kriteria/delete/{id}', [CriteriaController::class, 'hapusKriteria'])->name('kriteria.delete');

    Route::get('/data-subkriteria', [SubkriteriaController::class, 'getDataSubkriteria'])->name('data-subkriteria');
    Route::post('/data-subkriteria/tambah', [SubkriteriaController::class, 'tambahSubkriteria'])->name('subkriteria.add');
    Route::post('/data-subkriteria/update/{id}', [SubkriteriaController::class, 'perbaruiSubkriteria'])->name('subkriteria.update');
    Route::get('/data-subkriteria/delete/{id}', [SubkriteriaController::class, 'hapusSubkriteria'])->name('subkriteria.delete');

    Route::get('/data-atlet', [AthleteController::class, 'getDataAtlet'])->name('data-atlet');
    Route::post('/data-atlet/tambah', [AthleteController::class, 'tambahAtlet'])->name('atlet.add');
    Route::post('/data-atlet/update/{id}', [AthleteController::class, 'perbaruiAtlet'])->name('atlet.update');
    Route::get('/data-atlet/delete/{id}', [AthleteController::class, 'hapusAtlet'])->name('atlet.delete');

    Route::get('/nilai-preferensi-kriteria', [NilaiPreferensiController::class, 'nilaiPreferensiKriteria'])->name('nilai-preferensi-kriteria');
    Route::get('/nilai-preferensi-multikriteria', [PreferensiMultiKriteriaController::class, 'nilaiPreferensiMultiKriteria'])->name('nilai-preferensi-multikriteria');
    Route::get('/nilai-flow', [NilaiFlowController::class, 'nilaiFlow'])->name('nilai-flow');
    Route::get('/perankingan', [PerankinganController::class, 'perankingan'])->name('perankingan');
});

require __DIR__.'/auth.php';
