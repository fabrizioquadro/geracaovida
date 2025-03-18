<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nm_usuario' => 'Fabrizio Silveira Quadro',
            'email' => 'fabrizio.quadro@gmail.com',
            'password' => bcrypt('fabrizio'),
            'tp_usuario' => 'Administrador',
            'ds_genero' => 'Masculino',
        ]);
    }
}
