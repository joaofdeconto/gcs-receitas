<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    // Teste 11
    public function test_tela_de_login_carrega_corretamente(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Teste 12
    public function test_login_com_credenciais_validas_redireciona(): void
    {
        Usuario::create([
            'nome' => 'Teste', 'login' => 'teste', 'senha' => Hash::make('123456'), 'situacao' => 'ativo',
        ]);

        $response = $this->post('/login', ['login' => 'teste', 'senha' => '123456']);
        $response->assertRedirect(route('receitas.index'));
    }

    // Teste 13
    public function test_login_com_credenciais_invalidas_retorna_erro(): void
    {
        $response = $this->post('/login', ['login' => 'naoexiste', 'senha' => 'errado']);
        $response->assertSessionHasErrors('login');
    }

    // Teste 14
    public function test_usuario_inativo_nao_consegue_logar(): void
    {
        Usuario::create([
            'nome' => 'Inativo', 'login' => 'inativo', 'senha' => Hash::make('123456'), 'situacao' => 'inativo',
        ]);

        $response = $this->post('/login', ['login' => 'inativo', 'senha' => '123456']);
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    // Teste 15
    public function test_acesso_a_receitas_sem_login_redireciona_para_login(): void
    {
        $response = $this->get('/receitas');
        $response->assertRedirect('/login');
    }

    // Teste 16
    public function test_logout_invalida_sessao(): void
    {
        $usuario = Usuario::create([
            'nome' => 'Teste', 'login' => 'teste', 'senha' => Hash::make('123456'), 'situacao' => 'ativo',
        ]);

        $this->actingAs($usuario, 'web');
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
