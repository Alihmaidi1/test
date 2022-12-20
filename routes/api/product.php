<?php
use App\Http\Controllers\api\product;
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


    Route::post("/addproduct", [product::class, "store"]);
    Route::post("/editproduct", [product::class, "update"]);
    Route::post("/deleteproduct", [product::class, "delete"]);

});

Route::get("/getallproduct", [product::class, "getAllProduct"]);
