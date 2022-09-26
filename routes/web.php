<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;

Route::get('/upiti', [ProductController::class,"upitiView"]);
//Route::post('buy','ProductController@buy');
Route::get('/products/{id}/buy', [ProductController::class,"buy"])->name('products.buy');
//Route::get('/envios/{id}/notificar', 'EnvioController@notificar')->name('envios.notificar');
Route::resource('products', ProductController::class);
Route::get('/dashboard', [AuthController::class,"dashboard"]);
Route::get('/logout', [AuthController::class,"logout"]);
Route::get('/login', [AuthController::class,"loginView"]);
Route::get('/register', [AuthController::class,"registerView"]);
Route::post('/do-login', [AuthController::class,"doLogin"]);
Route::post('/do-register', [AuthController::class,"doRegister"]);
Route::get('/', function () {
    return redirect('products');
});
