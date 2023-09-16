<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('perfil', function () {
    $user = auth()->user();
    return view('perfil');

});

Route::get('lojas', function () {
    $parceiras = \App\Models\Parceira::all();
    dd($parceiras);
});

Auth::routes();


Route::get('/selecionar-parceira', 'ParceiraController@index')->name('selecionar.parceira');
Route::post('/selecionar-parceira', 'ParceiraController@selecionar')->name('selecionar.parceira.post');
Route::get('/dashboard/parceira/{id}', [\App\Http\Controllers\ParceiraController::class, 'dashboard'])->name('dashboard.selecionar');


Route::get('dashboard',function (){
    dd(auth()->user()->parceira);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
