<?php

use App\Http\Controllers\AdminController;
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

//Admin Routes
Route::get('/admin_users', [AdminController::class, 'admin_users'])->middleware(['admin_api_auth'])->name('admin_users');
Route::get('/admin_user', [AdminController::class, 'admin_user'])->middleware(['admin_api_auth'])->name('admin_user');
Route::get('/admin_add_user', [AdminController::class, 'admin_add_user'])->middleware(['admin_api_auth'])->name('admin_add_user');
Route::get('/admin_edit_user', [AdminController::class, 'admin_edit_user'])->middleware(['admin_api_auth'])->name('admin_edit_user');
Route::post('/admin_api_add_user', [AdminController::class, 'admin_api_add_user'])->middleware(['admin_api_auth'])->name('admin_api_add_user');
Route::post('/admin_api_edit_user', [AdminController::class, 'admin_api_edit_user'])->middleware(['admin_api_auth'])->name('admin_api_edit_user');
Route::post('/admin_api_delete_user', [AdminController::class, 'admin_api_delete_user'])->middleware(['admin_api_auth'])->name('admin_api_delete_user');

//User Routes
Route::get('/charts', [PanelController::class, 'charts'])->middleware(['api_auth']);
Route::get('/tables', [PanelController::class, 'tables'])->middleware(['api_auth']);
Route::get('/user_account', [PanelController::class, 'user_account'])->middleware(['api_auth']);
Route::get('/charts_data', [PanelController::class, 'charts_data'])->middleware(['api_auth']);
Route::get('/dashboard/{system_id?}', [PanelController::class, 'dashboard_data'])->middleware(['api_auth']);


//Login Routes
Route::get('/login', [PanelController::class, 'login'])->name('login');
Route::get('/logout', [PanelController::class, 'logout'])->name('logout');
Route::post('/check_login', [PanelController::class, 'check_login'])->name('check_login');
