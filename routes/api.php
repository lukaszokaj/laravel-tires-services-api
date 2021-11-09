<?php

use App\Http\Controllers\AdminSwapController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserSwapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('admin/date', [AdminSwapController::class, 'index']); //wyświetlanie administratorowi wszystkich terminów
  Route::get('admin/date/busy', [AdminSwapController::class, 'busy']);//wyświetlanie administratorowi zajętych terminów
  Route::get('admin/date/{id}', [AdminSwapController::class, 'show']);//wyświetlanie administratorowi pojedynczego terminu
  Route::delete('admin/date/{id}', [AdminSwapController::class, 'destroy']);//usuwanie przez administratora wybranego terminu
  Route::post('admin/date', [AdminSwapController::class, 'store']);//dodawanie przez administratora nowego terminu

  Route::post('/logout', [AdminAuthController::class, 'logout']);//wylogowywanie administratora
});


// Public routes
Route::get('user/date', [UserSwapController::class, 'index']);//wyświetlanie klientowi wolnych terminów
Route::put('user/book/first', [UserSwapController::class, 'firstFreeBook']);//rezerwowanie przez klienta pierwszego wolnego terminu
Route::put('user/book/{id}', [UserSwapController::class, 'book']);//rezerwowanie eolnego wybranego terminu
Route::put('user/cancel', [UserSwapController::class, 'cancelBook']);//anulowanie przez klienta rezerwacji

Route::post('/login', [AdminAuthController::class, 'login']);//logowanie
