<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

use Faker\Generator as Faker;

use Models\Pessoa;
use Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $this->command->warn("Esvaziando DB");
        $this->command->call('migrate:fresh');
        $this->command->warn("Iniciando novo DB");

        Pessoa::create([
            'nome_completo' => 'Administrador',
            'data_nascimento' => '2020/01/01',
            'cpf' => '',
            'sexo' => 1,
        ])->user()->save(new User([
            'name' => 'Administrador',
            'email' => 'admin',
            'password' => bcrypt('999999'),
        ]));

        if (App::environment() === 'local') {
            $this->call([DevelopSeeder::class]);
        }

        $this->command->call('passport:install');
    }
}
