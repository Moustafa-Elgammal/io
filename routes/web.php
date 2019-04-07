<?php

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


Route::group(['prefix' => 'posts', 'middleware'=>['posts'] ],function (){
    Route::get('/', 'PostsController@index');
    Route::get('/{id}', 'PostsController@show');
    Route::get('/{id}/recover', 'PostsController@recover')->middleware('postsOwners');
    Route::post('/{id}/delete', 'PostsController@delete')->middlerware('postsOwners');
    Route::post('/{id}/update', 'PostsController@update')->middlerware('postsOwners');
});