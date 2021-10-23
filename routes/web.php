<?php

use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [PanelController::class, 'dashboard'])->middleware(['api_auth'])->name('dashboard');
//Route::get('/{system_id?}', [PanelController::class, 'dashboard'])->middleware(['api_auth']);
Route::get('/dashboard/{system_id?}', [PanelController::class, 'dashboard_data'])->middleware(['api_auth']);

//Route::get('/login',function (){return "Hello login";} )->name('login');
Route::get('/login', [PanelController::class, 'login'])->name('login');
Route::post('/check_login', [PanelController::class, 'check_login'])->name('check_login');
