<?php

use App\Http\Controllers\LgaCountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\NewPollingUnitController;


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

Route::get('/', function () {
    return view('welcome');
})->name('home');
//QUESTION 1
Route::get('/polling-units', [PollingUnitController::class, 'index'])->name('show.pollingunit');
Route::get('/wards/{lga_id}', [PollingUnitController::class, 'getWards']);
Route::get('/polling-units/{ward_id}/units', [PollingUnitController::class, 'getPollingUnits']);
Route::get('/polling-units/{polling_unit_id}/results', [PollingUnitController::class, 'getResults']);

//QUESTION 2
Route::get('/lga-summary', [LgaCountController::class, 'lgaSummary'])->name('lga.summary');
Route::get('/lga-summary/{lga_id}', [LgaCountController::class, 'getLgaSummary']);

//QUESTION 3
Route::get('/new-polling-unit/create', [NewPollingUnitController::class, 'create'])->name('new-polling-unit.create');
Route::post('/new-polling-unit/store', [NewPollingUnitController::class, 'store'])->name('new-polling-unit.store');