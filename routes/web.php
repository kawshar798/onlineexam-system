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

    Route::get('students','StudentController@index');

    Route::get('categories','BlogCategoryController@index');
    Route::post('category/store','BlogCategoryController@store');
    Route::put('category/active/{id}','BlogCategoryController@active');
    Route::put('category/inactive/{id}','BlogCategoryController@inactive');
    Route::delete('category/delete/{id}','BlogCategoryController@destroy');

    Route::get('posts','PostController@index');
    Route::post('post/store','PostController@store');
    Route::put('post/active/{id}','PostController@active');
    Route::put('post/inactive/{id}','PostController@inactive');
    Route::delete('post/delete/{id}','PostController@destroy');

    Route::get('teams','TeamController@index');
    Route::post('team/store','TeamController@store');
    Route::put('team/active/{id}','TeamController@active');
    Route::put('team/inactive/{id}','TeamController@inactive');
    Route::delete('team/delete/{id}','TeamController@destroy');



    Route::get('video-lectures','VideoLectureController@index');
    Route::post('video-lecture/store','VideoLectureController@store');
    Route::put('video-lecture/active/{id}','VideoLectureController@active');
    Route::put('video-lecture/inactive/{id}','VideoLectureController@inactive');
    Route::delete('video-lecture/delete/{id}','VideoLectureController@destroy');

    Route::get('services','ServiceController@index');
    Route::post('service/store','ServiceController@store');
    Route::put('service/active/{id}','ServiceController@active');
    Route::put('service/inactive/{id}','ServiceController@inactive');
    Route::delete('service/delete/{id}','ServiceController@destroy');


    Route::get('pdf-files','PdfFileController@index');
    Route::post('pdf-file/store','PdfFileController@store');
    Route::put('pdf-file/active/{id}','PdfFileController@active');
    Route::put('pdf-file/inactive/{id}','PdfFileController@inactive');
    Route::delete('pdf-file/delete/{id}','PdfFileController@destroy');

});
Route::group(['prefix'=>'student','namespace'=>'Student','middleware'=>['auth','student']],function (){
    Route::get('dashboard','StudentController@index');
});
