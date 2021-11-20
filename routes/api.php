<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/patients', [PasienController::class, 'index']); //Get All Resource
Route::post('/patients', [PasienController::class, 'store']); //Add Resource
Route::get('/patients/{id}', [PasienController::class, 'show']); //Get Detail Resource
Route::put('/patients/{id}', [PasienController::class, 'update']); //Edit Resource
Route::delete('/patients/{id}', [PasienController::class, 'destroy']); //Delete Resource
Route::get('/patients/search/{name}', [PasienController::class, 'search']); //Search Resource by Name
Route::get('/patients/status/positive', [PasienController::class, 'positive']); //Get Positive Resource
Route::get('/patients/status/recovered', [PasienController::class, 'recovered']); //Get Recovered Resource
Route::get('/patients/status/dead', [PasienController::class, 'dead']); //Get Dead Resource