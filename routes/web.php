<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PenjualanController;

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

Route::get('/', [PenjualanController::class, 'index'])->name('dashboard');

// Route opsional untuk seeding database (hapus setelah digunakan di Vercel)
Route::get('/seed', function () {
    Artisan::call('db:seed', ['--class' => 'PenjualanSeeder']);
    return 'Seeding done!';
});