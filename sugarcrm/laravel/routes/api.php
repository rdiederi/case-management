<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::prefix('module')->controller(ApiController::class)->group(function () {
    Route::get("/lt_case/create", 'createCase');
    Route::get("/lt_case/get/{case}", 'getCase');
    Route::get("/lt_customer/get/{id}", 'getCustomer');
    Route::get("/lt_courses", 'getCourses');

    Route::post("/lt_customer/create", 'createCustomer');

    Route::put("/lt_case/{id}/remove-customer", 'removeCustomerFromCase');
    Route::put("/lt_case/{id}/add-customer", 'addCustomerToCase');
});

Route::prefix('lists')->controller(ApiController::class)->group(function () {
    Route::get("/customers", 'getCustomers');
    Route::get("/customers/with-policy-names", 'getCustomersWithPolicyNames');

    Route::put("/customers/update-id-number-status", 'updateHasCorrectIdNumber');
});

