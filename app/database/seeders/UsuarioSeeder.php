<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nome'     => 'João Admin',
            'login'    => 'admin',
            'senha'    => Hash::make('senha123'),
            'situacao' => 'ativo',
        ]);
    }
}
