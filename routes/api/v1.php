<?php

use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\RegistrationController;
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

Route::resource('/courses', CourseController::class);
Route::resource('/courses/{course}/registrations', RegistrationController::class);
