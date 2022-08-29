<?php

use App\Http\Controllers\Web\Servers\ServerController;
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

Route::get('/', function () {
    return view('welcome');
});

// start server routes:
Route::group(['as' => 'servers.', 'prefix' => 'servers'], function () {
    Route::get('/', [ServerController::class, 'index'])->name('index');
});
Route::resource('servers', ServerController::class);
