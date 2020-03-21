<?php

use Illuminate\Database\Seeder;

use Models\Base\Pessoa;
use Models\Authentication\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::create([
            'nomeCompleto' => 'Administrador',
            'dataNascimento' => '01/01/2020',
            'cpf' => '',
            'sexo' => 1,
            'falecido' => false
        ])->user()->save(new User([
            'name' => 'Administrador',
            'email' => 'admin',
            'password' => bcrypt('999999'),
        ]));
    }
}
