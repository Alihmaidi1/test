<?php

use App\Http\Controllers\api\unit;
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


Route::group(["middleware" => "jwtToken"], function () {

    Route::post("/addunit", [unit::class, "store"]);
    Route::post("/editunit", [unit::class, "update"]);
    Route::post("/deleteunit", [unit::class, "delete"]);
});

Route::get("/getallunit", [unit::class, "getAllUnit"]);
