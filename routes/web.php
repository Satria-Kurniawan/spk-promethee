<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\NilaiFlowController;
use App\Http\Controllers\NilaiPreferensiController;
use App\Http\Controllers\PerankinganController;
use App\Http\Controllers\PreferensiMultiKriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubkriteriaController;
use App\Models\Alternatif;
use App\Models\Criteria;
use App\Models\Subkriteria;
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

Route::get('/', [PerankinganController::class, 'welcome']);

Route::get('/dashboard', function () {
    $jumlahKriteria = count(Criteria::all());
    $jumlahSubkriteria = count(Subkriteria::all());
    $jumlahAlternatif = count(Alternatif::all());

    return view('dashboard', compact('jumlahKriteria', 'jumlahSubkriteria', 'jumlahAlternatif'));
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

    Route::get('/data-alternatif', [AlternatifController::class, 'getDataAlternatif'])->name('data-alternatif');
    Route::post('/data-alternatif/tambah', [AlternatifController::class, 'tambahAlternatif'])->name('alternatif.add');
    Route::post('/data-alternatif/update/{id}', [AlternatifController::class, 'perbaruiAlternatif'])->name('alternatif.update');
    Route::get('/data-alternatif/delete/{id}', [AlternatifController::class, 'hapusAlternatif'])->name('alternatif.delete');

    Route::get('/nilai-preferensi-kriteria', [NilaiPreferensiController::class, 'nilaiPreferensiKriteria'])->name('nilai-preferensi-kriteria');
    Route::get('/nilai-preferensi-multikriteria', [PreferensiMultiKriteriaController::class, 'nilaiPreferensiMultiKriteria'])->name('nilai-preferensi-multikriteria');
    Route::get('/nilai-flow', [NilaiFlowController::class, 'nilaiFlow'])->name('nilai-flow');
    Route::get('/perankingan', [PerankinganController::class, 'perankingan'])->name('perankingan');

    Route::get('/data-atlet/input', [AthleteController::class, 'inputAtlet'])->name('atlet.input');
    Route::post('/data-atlet/tambah', [AthleteController::class, 'tambahAtlet'])->name('atlet.add');
});

require __DIR__.'/auth.php';
