<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Models\Pessoa::class, function (Faker $faker) {
    return [
        'nome_completo' => $faker->name(),
        'data_nascimento' => $faker->date('Y/m/d'),
        'cpf' => $faker->cpf(false),
        'email' => $faker->email(),
        'telefone' => $faker->cellphoneNumber(),
        'sexo' => $faker->randomElement(['masculino', 'feminino']),
    ];
});

$factory->define(Models\Cargo::class, function (Faker $faker) {
    return [
        'nome' => $faker->jobTitle(),
        'inativo' => $faker->boolean(),
    ];
});

$factory->define(Models\UnidadeEscolar::class, function (Faker $faker) {
    $name = $faker->company();
    return [
        'inep' => $faker->randomNumber(8, true),
        'nome_completo' => $name,
        'nome_abreviado' => Str::slug($name, '-'),
        'inativo' => $faker->boolean,
    ];
});
