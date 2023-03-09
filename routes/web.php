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

Route::namespace('site')->group(function(){
    Route::view('/', 'home')->name('home');

    Route::resource('empresa', 'EmpresaController', ['names'=>'empresa'])->except('show');
    Route::resource('fornecedor', 'FornecedorController', ['names'=>'fornecedor'])->except('show');
});
