<?php
use App\Http\Controllers\api\image;
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


    Route::post("/addimage", [image::class, "store"]);
    Route::post("/deleteimage",[image::class, "delete"]);
});

