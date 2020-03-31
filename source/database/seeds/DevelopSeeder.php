<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use Models\Pessoa;
use Models\Cargo;
use Models\UnidadeEscolar;
use Models\AnoEscolaridade;
use Models\AnoLetivo;

class DevelopSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $this->command->info("Dados de testes sendo inseridos...");

        factory(Pessoa::class, 150)->create();
        factory(Cargo::class, 8)->create();
        factory(UnidadeEscolar::class, 8)->create();

        for ($i=1; $i < 10 ; $i++) {
            AnoEscolaridade::create([
                'nome_completo' => $i . 'º Ano',
                'nome_abreviado' => $i,
                'inativo' => $faker->boolean()
            ]);
        }

        for ($i=2010; $i < 2020 ; $i++) {
            AnoLetivo::create([
                'ano_letivo' => $i,
                'inativo' => $faker->boolean()
            ]);
        }
    }
}
