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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function (){
    Route::get('dashboard','DashboardController@index');
    Route::get('categories','BlogCategoryController@index');
    Route::post('category/store','BlogCategoryController@store');
    Route::any('category/active/{id}','BlogCategoryController@active');
    Route::any('category/inactive/{id}','BlogCategoryController@inactive');
    Route::any('category/delete/{id}','BlogCategoryController@destroy');
    Route::get('posts','PostController@index');
    Route::post('post/store','PostController@store');
    Route::any('post/active/{id}','PostController@active');
    Route::any('post/inactive/{id}','PostController@inactive');
    Route::any('post/delete/{id}','PostController@destroy');
});
Route::group(['prefix'=>'student','namespace'=>'Student','middleware'=>['auth','student']],function (){
    Route::get('dashboard','StudentController@index');
});
