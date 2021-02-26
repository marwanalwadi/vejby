<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\SubCategoryController;


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



Route::post('/vejbyregister', [AuthController::class, 'register']);
Route::post('/vejbylogin', [AuthController::class, 'login']);
Route::get('/category', [CategoryController::class, 'index']);

Route::get('/details', [DetailsController::class, 'index']);
Route::get('/details/{id}', [DetailsController::class, 'show']);

Route::get('/contact', [ContactController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'contactSubmit']);


Route::get('/subcategory', [SubCategoryController::class, 'index']);

//Route::resource('category', CategoryController::class);
//Route::resource('details', DetailsController::class);
//Route::resource('subcategory', SubCategoryController::class);




Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/category', [CategoryController::class, 'store']);

    // Details Routes
    Route::post('/details', [DetailsController::class, 'store']);
    Route::put('/details/{id}', [DetailsController::class, 'update']);
    Route::delete('/details/{id}', [DetailsController::class, 'destroy']);


    //subctegory routes

    Route::post('/subcategory', [SubCategoryController::class, 'store']);

    //  Route::get('/vejbylogout', [AuthController::class, 'logout']);

    Route::post('/vejbylogout', [AuthController::class, 'logout']);
});