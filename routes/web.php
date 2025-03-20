<?php

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

use App\Http\Controllers\Admin\HotelController;

Route::prefix('admin')->group(function () {
    Route::resource('hotels', HotelController::class);
});

Route::get('hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
