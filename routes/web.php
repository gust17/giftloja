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
Route::get('exibir/recibo/{id}',[\App\Http\Controllers\AdminController::class,'recibo'])->name('recibo')->middleware('auth');
Route::get('saque',[\App\Http\Controllers\AdminController::class,'saque'])->name('saque')->middleware('auth');
Route::get('users',[\App\Http\Controllers\AdminController::class,'users'])->name('users')->middleware('auth');
Route::post('gerarsaque',[\App\Http\Controllers\AdminController::class,'gerarsaque'])->name('gerarsaque')->middleware('auth');
Route::get('user/busca',[\App\Http\Controllers\AdminController::class,'buscaUser'])->middleware('auth');
Route::post('user/consulta',[\App\Http\Controllers\AdminController::class,'consultaUser'])->middleware('auth');
Route::post('user/edit',[\App\Http\Controllers\AdminController::class,'editUser'])->middleware('auth');
Route::post('user/newUser',[\App\Http\Controllers\AdminController::class,'newUser'])->middleware('auth');
Route::get('user/edit/{id}',[\App\Http\Controllers\AdminController::class,'editUserUnico'])->middleware('auth');
Route::get('user/ativar/{id}',[\App\Http\Controllers\AdminController::class,'ativarUserUnico'])->middleware('auth');
Route::get('newUser/{cpf}',[\App\Http\Controllers\AdminController::class,'newUserForm'])->middleware('auth');
Route::get('user/desabilitar/{id}',[\App\Http\Controllers\AdminController::class,'desabilitarUserUnico'])->middleware('auth');

Route::get('/trocar-senha', [\App\Http\Controllers\AuthTrocarSenhaController::class, 'index'])->name('trocar-senha');
Route::post('/salvar-nova-senha', [\App\Http\Controllers\AuthTrocarSenhaController::class, 'salvarNovaSenha'])->name('salvar-nova-senha');
Route::get('meuperfil', function () {
    $page = 'Meu Perfil';
    return view('profile.perfil', compact('page'));
})->middleware('auth')->name('meuperfil');


