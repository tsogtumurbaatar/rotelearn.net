<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('index');   
}); 

Route::get('/quiz', function () {
    return view('index');   
}); 

Route::get('/result', function () {
    return view('index');   
}); 

Route::get('/whatis', function () {
    return view('whatis');   
}); 


Route::post('/quiz', 'QuizController@index');
Route::post('/result', 'QuizController@result');
Route::get('/list', 'QuizController@verblist');
Route::post('/list', 'QuizController@verblist');


Auth::routes();

Route::get('/home', 'HomeController@index');
