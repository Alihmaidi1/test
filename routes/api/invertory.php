<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\invertory;
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

Route::group(["middleware" => "jwtToken"], function () {

    Route::post("/addinvertory", [invertory::class, "store"]);
    Route::post("/deleteinvertory", [invertory::class, "delete"]);

});

