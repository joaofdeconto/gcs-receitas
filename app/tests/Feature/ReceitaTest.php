<?php

namespace Tests\Feature;

use App\Models\Receita;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ReceitaTest extends TestCase
{
    use RefreshDatabase;

    private Usuario $usuario;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuario = Usuario::create([
            'nome'     => 'Admin',
            'login'    => 'admin',
            'senha'    => Hash::make('123456'),
            'situacao' => 'ativo',
        ]);
    }

    // Teste 17
    public function test_listagem_de_receitas_retorna_200(): void
    {
        $response = $this->actingAs($this->usuario)->get('/receitas');
        $response->assertStatus(200);
    }

    // Teste 18
    public function test_criar_receita_persiste_no_banco(): void
    {
        $this->actingAs($this->usuario)->post('/receitas', [
            'nome'          => 'Torta Teste',
            'descricao'     => 'Descrição',
            'data_registro' => '2026-01-01',
            'custo'         => 30.00,
            'tipo_receita'  => 'doce',
        ]);

        $this->assertDatabaseHas('receitas', ['nome' => 'Torta Teste']);
    }

    // Teste 19
    public function test_editar_receita_atualiza_no_banco(): void
    {
        $receita = Receita::create([
            'nome'          => 'Receita Antiga',
            'descricao'     => 'Desc',
            'data_registro' => '2026-01-01',
            'custo'         => 10.00,
            'tipo_receita'  => 'salgada',
        ]);

        $this->actingAs($this->usuario)->put("/receitas/{$receita->id}", [
            'nome'          => 'Receita Nova',
            'descricao'     => 'Desc',
            'data_registro' => '2026-01-01',
            'custo'         => 20.00,
            'tipo_receita'  => 'doce',
        ]);

        $this->assertDatabaseHas('receitas', ['nome' => 'Receita Nova']);
    }

    // Teste 20
    public function test_excluir_receita_remove_do_banco(): void
    {
        $receita = Receita::create([
            'nome'          => 'Para Excluir',
            'descricao'     => 'Desc',
            'data_registro' => '2026-01-01',
            'custo'         => 5.00,
            'tipo_receita'  => 'doce',
        ]);

        $this->actingAs($this->usuario)->delete("/receitas/{$receita->id}");
        $this->assertDatabaseMissing('receitas', ['nome' => 'Para Excluir']);
    }
}
