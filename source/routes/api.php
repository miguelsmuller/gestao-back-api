<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'Api\AuthController@login')->name('auth.login');
Route::post('/register', 'Api\AuthController@register')->name('auth.register');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/info', 'Api\AuthController@info')->name('auth.info');
    Route::post('/logout', 'Api\AuthController@logout')->name('auth.logout');

    Route::apiResource('pessoas', 'Api\PessoaController')->except(['destroy']);
    Route::apiResource('anos-letivos', 'Api\AnoLetivoController')->except(['destroy']);
    Route::apiResource('cargos', 'Api\CargoController')->except(['destroy']);
    Route::apiResource('unidades-escolares', 'Api\UnidadeEscolarController')->except(['destroy']);
    Route::apiResource('anos-escolaridades', 'Api\AnoEscolaridadeController')->except(['destroy']);

    Route::apiResource('vinculos-profissionais/unidade-escolar/{ref}', 'Api\VinculoProfissionalController')
        ->only(['index'])->names(['index' => 'vinculos-profissionais.unidade-escolar.index']);
    Route::apiResource('vinculos-profissionais/pessoa/{ref}', 'Api\VinculoProfissionalController')
        ->only(['index'])->names(['index' => 'vinculos-profissionais.pessoa.index']);;

    Route::apiResource('vinculos-profissionais', 'Api\VinculoProfissionalController')->except(['index', 'show', 'destroy']);
    Route::apiResource('vinculos-profissionais', 'Api\VinculoProfissionalController')->except(['index', 'show', 'destroy']);
});
