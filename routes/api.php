<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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

//Get method
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']); //Read
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('user/list',[RouteController::class,'userList']);

//Post Method
Route::post('create/category',[RouteController::class,'categoryCreate']); //Create
Route::post('create/contact',[RouteController::class,'contactCreate']);

Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']); //Delete

Route::get('category/list/{id}',[RouteController::class,'categoryDetails']); //Read

Route::post('category/update',[RouteController::class,'categoryUpdate']); //Update
