<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkHoursController;
use App\Http\Controllers\EmployeeController;

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

//Auth
Auth::routes();
Route::resource('MyWorkHours', WorkHoursController::class)->middleware('auth');
Route::resource('Employees', EmployeeController::class)->middleware('auth');

//HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//WorkHoursController
Route::get('/MyWorkHours',[WorkHoursController::class, 'index']);
Route::get('/ManageWorkHours/{id}',[WorkHoursController::class, 'ManageWorkHours']);
Route::get('/AddWorkHour/{id}',[WorkHoursController::class, 'AddWorkHour']);
Route::get('/DeleteWorkHour/{id}',[WorkHoursController::class, 'DeleteWorkHour']);
Route::post('StoreWorkHour',[WorkHoursController::class, 'StoreWorkHour']);
Route::get('/ChangeWorkHour/{id}',[WorkHoursController::class, 'ChangeWorkHour']);
Route::put('EditWorkHour/{id}',[WorkHoursController::class, 'EditWorkHour']);

//EmployeeController
Route::get('/EmployeeList',[EmployeeController::class, 'index']);
Route::get('/EmployeeListUser',[EmployeeController::class, 'EmployeeListUser']);
Route::get('/EditUserForm/{id}',[EmployeeController::class, 'EditUserForm']);
Route::put('/UpdateUser/{id}',[EmployeeController::class, 'UpdateUser']);