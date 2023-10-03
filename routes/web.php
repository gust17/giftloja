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

Route::get('home',function (){
    return redirect(url('perfil'));
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/register', function () {
    return redirect()->route('dashboard');
});

Route::get('perfil', function () {
    $user = auth()->user();
    return view('perfil');

})->middleware('auth')->name('perfil');

Route::get('lojas', function () {
    $parceiras = \App\Models\Parceira::all();
    dd($parceiras);
});

Auth::routes();


Route::get('/selecionar-parceira', 'ParceiraController@index')->name('selecionar.parceira');
Route::post('/selecionar-parceira', 'ParceiraController@selecionar')->name('selecionar.parceira.post');
Route::get('/dashboard/parceira/{id}', [\App\Http\Controllers\ParceiraController::class, 'dashboard'])->name('dashboard.selecionar');


Route::get('dashboard', function () {

    $user = auth()->user();
    if (auth()->user()->parceira_selecionada) {
        if ($user->parceira->adminstrador == 1) {


            $page = 'Frente de Loja';
            return view('loja.padrao', compact('page'));

        }else{
            return redirect()->route('caixa');
        }
    }else{

    }
    return redirect()->route('perfil');
})->middleware('auth')->name('dashboard');

Route::get("caixa",[\App\Http\Controllers\FrenteCaixaController::class,'index'])->name('caixa')->middleware('auth');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('finalizaVenda',[\App\Http\Controllers\FrenteCaixaController::class,'finaliza'])->middleware('auth');


Route::get('movimento',[\App\Http\Controllers\AdminController::class,'movimento'])->name('movimento')->middleware('auth');
Route::get('saque',[\App\Http\Controllers\AdminController::class,'saque'])->name('saque')->middleware('auth');
Route::get('users',[\App\Http\Controllers\AdminController::class,'users'])->name('users')->middleware('auth');
Route::post('gerarsaque',[\App\Http\Controllers\AdminController::class,'gerarsaque'])->name('gerarsaque')->middleware('auth');


