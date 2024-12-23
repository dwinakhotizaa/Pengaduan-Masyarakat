<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\CommentController;

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
    return view('layout');
});


Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.form');

Route::get('/dashboard', function () {
    return view('headstaff.akun');
});

Route::prefix('/akun')->name('akun.')->group(function () {
    // /akun/data adalah rute untuk menampilkan data pengguna.
    // [UserController::class, 'index'] berarti ketika rute ini dipanggil, maka method index di UserController akan dijalankan.
    // Nama rute ini adalah akun.data
    Route::get('/data', [UserController::class, 'index'])->name('data');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/tambah', [UserController::class, 'store'])->name('tambah.akun');
    // menampilkan form edit dan hapus berdasarkan ID pengguna.
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    //PATCH : update only certain fields of a resource, rather than replacing the entire resource.
    Route::patch('/edit/{id}', [UserController::class, 'update'])->name('edit.akun');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('delete.akun');
    Route::get('/user/export-excel', [UserController::class, 'exportExcel'])->name('export');
});

Route::post('/report/index/{id}/vote', [ReportController::class, 'vote'])->name('report.vote');
Route::prefix('/report')->name('report.')->group(function () {
    Route::delete('/report/{id}/hapus/report', [ReportController::class, 'destroy'])->name('destroy');
    Route::get('/pengaduan', [ReportController::class, 'index'])->name('pengaduan');
    Route::get('/keluhan/create', [ReportController::class, 'create'])->name('create');
    Route::get('/show/{id}', [ReportController::class, 'show'])->name('show');
    Route::get('/form-report', function () {
        return view('report.form-report');
    })->name('form.report');
    Route::post('/submit-report', [ReportController::class, 'store'])->name('submit'); // Middleware auth;
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
    Route::get('/article', [ReportController::class, 'article'])->name('report.article');
   Route::post('/reports/{id}/comments', [CommentController::class, 'store'])->name('comment.store');
    // Rute untuk menyimpan pengaduan
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    // Route untuk membuat laporan
Route::get('/guest/create-report', [ReportController::class, 'create'])->name('guest_create_report');

});
