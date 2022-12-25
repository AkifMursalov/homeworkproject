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


Route::get('/questions.show/{id}', 'App\Http\Controllers\Question@show')->name('questions.show');

Route::get('/questions.edit/{id}', 'App\Http\Controllers\Question@edit')->name('questions.edit');

Route::get('/create', function () {
    return view('create');
});

Route::get('/',"App\Http\Controllers\Question@index")->name('home.show');

Route::post('/authorization', "App\Http\Controllers\User@login");

Route::post('/questions.update/{id}', 'App\Http\Controllers\Question@update')->name('questions.update');

Route::post('/questions.create', 'App\Http\Controllers\Question@create')->name('questions.create');

Route::post('/delete/{id}', 'App\Http\Controllers\Question@delete')->name('questions.delete');




