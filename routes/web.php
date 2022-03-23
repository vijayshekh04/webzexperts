<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


// Products


Route::get('/',[ProductController::class, 'index']);
Route::post('get-subcategory',[ProductController::class, 'getSubCategory']);
Route::post('product/destroy',[ProductController::class, 'destroy']);
Route::match(['post'],'product/datatable',[ProductController::class, 'datatable']);
Route::resource('product',ProductController::class);
