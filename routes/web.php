<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\KurikulumController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('/password/reset', function () {
        return redirect('/login');
    });
    Route::get('/register', function () {
        return redirect('/login');
    });

    Auth::routes([
        'password.reset' => false,
        'verify' => false,
        'password.request' => false,
        'reset' => false,
        'register' => false,
    ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/guru/home', [GuruController::class, 'index'])->name('guru.home');
        Route::get('/guru/upload-rpp', [GuruController::class, 'uploadRpp'])->name('guru.upload-rpp');
        Route::post('/guru/upload-rpp/post', [GuruController::class, 'uploadRppPost'])->name('guru.upload-rpp.post');


        Route::group(['middleware' => 'kepsek'], function () {
            Route::get('/kepsek/home', [KepsekController::class, 'index'])->name('kepsek.home');
            Route::get('/kepsek/laporan', [KepsekController::class, 'laporan'])->name('kepsek.laporan');
        });

        Route::group(['middleware' => 'supervisor'], function () {
            Route::get('/supervisor/jadwal', [SupervisorController::class, 'jadwal'])->name('supervisor.jadwal');
            Route::get('/supervisor/nilai', [SupervisorController::class, 'nilaijadwal'])->name('supervisor.nilai');
            Route::patch('/supervisor/nilai/post/{id}', [SupervisorController::class, 'nilaipost'])->name('supervisor.nilai.post');
            Route::patch('/supervisor/nilai/tidaklulus/post/{id}', [SupervisorController::class, 'nilaitidakluluspost'])->name('supervisor.nilai.tidaklulus.post');
        });

        Route::group(['middleware' => 'kurikulum'], function () {
            Route::get('/kurikulum/home', [KurikulumController::class, 'index'])->name('kurikulum.index');

            Route::get('/kurikulum/laporan', [KurikulumController::class, 'laporan'])->name('kurikulum.laporan');

            Route::get('/kurikulum/guru/add', [KurikulumController::class, 'guruAdd'])->name('kurikulum.guru.add');
            Route::post('/kurikulum/guru/add/post', [KurikulumController::class, 'guruAddPost'])->name('kurikulum.guru.add.post');
            Route::get('/kurikulum/guru/tosupervisor/{id}', [KurikulumController::class, 'tosupervisor'])->name('kurikulum.to.supervisor');
            Route::get('/kurikulum/guru/deletesupervisor/{id}', [KurikulumController::class, 'deletesupervisor'])->name('kurikulum.delete.supervisor');

            Route::get('/kurikulum/jadwals', [KurikulumController::class, 'jadwal'])->name('kurikulum.jadwal');
            Route::get('/kurikulum/jadwal/add', [KurikulumController::class, 'jadwalAdd'])->name('kurikulum.jadwal.add');
            Route::get('/kurikulum/jadwal/delete/{id}', [KurikulumController::class, 'jadwalDelete'])->name('kurikulum.jadwal.delete');
            Route::post('/kurikulum/jadwal/add/post', [KurikulumController::class, 'jadwalAddPost'])->name('kurikulum.jadwal.add.post');
        });
    });
});
