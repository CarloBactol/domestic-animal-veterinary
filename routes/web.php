<?php

use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminOwner;
use App\Http\Controllers\Admin\AdminAnimal;
use App\Http\Controllers\Admin\AdminBranch;
use App\Http\Controllers\Admin\AdminService;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminVeterinary;

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
    $location = Location::orderBy('lat', 'ASC')
        ->where('status', '1')
        ->get();
    return view('welcome', compact('location'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('admin_dashboards', AdminDashboard::class)->only('index', 'show');
        Route::resource('admin_owners', AdminOwner::class)->except('show');
        Route::resource('admin_animals', AdminAnimal::class)->except('show');
        Route::resource('admin_veterinaries', AdminVeterinary::class)->except('show');
        Route::resource('admin_branchs', AdminBranch::class)->except('show');
        Route::resource('admin_services', AdminService::class)->except('show');
    });
});
