<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SugarcrmController;
use App\Http\Controllers\SidebarController;
use Illuminate\Support\Str;
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

Route::get('/instructions', function () {
    return view('instructions');
});

Route::get('/', function () {
    return redirect("/sidebar");
});


Route::prefix('sidebar')->controller(SidebarController::class)->group(function () {
    Route::get("/", 'index');
    Route::get("/left", 'left');
});

Route::get('/sidebar/right', [SugarcrmController::class, 'moduleView']);

Route::group(['prefix' => 'module'], function () {
    Route::get('{moduleName}/listview', [SugarcrmController::class, 'moduleListView']);
    Route::get('{moduleName?}/{id}/{view}', [SugarcrmController::class, 'moduleView']);
    Route::put('{moduleName?}/{id}', [SugarcrmController::class, 'moduleSave']);
});
