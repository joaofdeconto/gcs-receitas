<?php

namespace Database\Seeders;

use App\Models\Receita;
use Illuminate\Database\Seeder;

class ReceitaSeeder extends Seeder
{
    public function run(): void
    {
        $receitas = [
            ['nome' => 'Bolo de Chocolate',      'descricao' => 'Bolo fofinho com cobertura de chocolate', 'data_registro' => '2026-01-10', 'custo' => 25.50, 'tipo_receita' => 'doce'],
            ['nome' => 'Coxinha de Frango',      'descricao' => 'Salgado frito recheado com frango desfiado', 'data_registro' => '2026-01-12', 'custo' => 18.00, 'tipo_receita' => 'salgada'],
            ['nome' => 'Brigadeiro Gourmet',     'descricao' => 'Docinho de festa tradicional brasileiro', 'data_registro' => '2026-01-15', 'custo' => 12.00, 'tipo_receita' => 'doce'],
            ['nome' => 'Pão de Queijo',          'descricao' => 'Pão de queijo mineiro tradicional', 'data_registro' => '2026-01-18', 'custo' => 15.00, 'tipo_receita' => 'salgada'],
            ['nome' => 'Pudim de Leite',         'descricao' => 'Pudim cremoso com calda de caramelo', 'data_registro' => '2026-01-20', 'custo' => 20.00, 'tipo_receita' => 'doce'],
            ['nome' => 'Empada de Palmito',      'descricao' => 'Empadinha recheada com palmito refogado', 'data_registro' => '2026-01-22', 'custo' => 22.00, 'tipo_receita' => 'salgada'],
            ['nome' => 'Torta de Limão',         'descricao' => 'Torta gelada com creme de limão', 'data_registro' => '2026-01-25', 'custo' => 30.00, 'tipo_receita' => 'doce'],
            ['nome' => 'Quibe Assado',           'descricao' => 'Quibe de carne moída assado no forno', 'data_registro' => '2026-01-28', 'custo' => 28.00, 'tipo_receita' => 'salgada'],
            ['nome' => 'Mousse de Maracujá',     'descricao' => 'Mousse leve e refrescante de maracujá', 'data_registro' => '2026-02-01', 'custo' => 17.50, 'tipo_receita' => 'doce'],
            ['nome' => 'Esfiha de Carne',        'descricao' => 'Esfiha aberta com carne temperada', 'data_registro' => '2026-02-03', 'custo' => 16.00, 'tipo_receita' => 'salgada'],
        ];

        foreach ($receitas as $receita) {
            Receita::create($receita);
        }
    }
}
