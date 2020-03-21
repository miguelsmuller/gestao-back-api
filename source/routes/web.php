<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'Base\HomeController@index')->name('home');

    Route::resource('anos-letivos', 'Base\AnoLetivoController')->except(['show', 'destroy']);
    Route::resource('pessoas', 'Base\PessoaController')->except(['show', 'destroy']);
    Route::resource('cargos', 'Trabalhista\CargoController')->except(['show', 'destroy']);
    Route::resource('unidades-escolares', 'Educacional\UnidadeEscolarController')->except(['show', 'destroy']);
    Route::resource('anos-escolaridades', 'Educacional\AnoEscolaridadeController')->except(['show', 'destroy']);

    Route::prefix('api')->group(function () {
        //Route::resource('/unidades-escolares', 'UnidadeEscolarController');
        //Route::resource('/pessoas', 'PessoaController');
        //Route::resource('/cargos', 'CargoController');
    });

    Route::prefix('vinculos-profissionais')->group(function () {
        $controller = '';
        Route::get('/', array('uses' => 'Trabalhista\VinculoProfissionalController@list'))->name('listVinculo');
        Route::get('/visualizar/{cirme?}', array('uses' => 'Trabalhista\VinculoProfissionalController@view'))->name('viewVinculo');
        Route::post('/{id?}', array('uses' => 'Trabalhista\VinculoProfissionalController@save'))->name('saveVinculo');
    });
});
