<?php

use App\Http\Controllers\CovidCasesController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Covid Cases Api's Endpoint
Route::prefix('covid-case')->group(function () {
    Route::get('high/percentual/cases/{state}/{dateStart}/{dateEnd}/{perPage?}',
        [CovidCasesController::class, 'covidCases']
    )
        ->name('covid.cases.percentual');
});
