<?php

use App\Http\Middleware\BackOfficeAuth;
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

Auth::routes();

Route::middleware([BackOfficeAuth::class])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('tasks', 'TaskController');
    Route::resource('products', 'ProductController');
    Route::resource('prices', 'PriceController');
    Route::resource('faqs', 'FaqController');
});