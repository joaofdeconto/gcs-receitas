<?php

namespace Tests\Unit;

use App\Models\Receita;
use Tests\TestCase;

class ReceitaTest extends TestCase
{
    private Receita $receita;

    protected function setUp(): void
    {
        parent::setUp();
        $this->receita = new Receita([
            'nome'          => 'Bolo Teste',
            'descricao'     => 'Descrição teste',
            'data_registro' => '2026-01-01',
            'custo'         => 25.50,
            'tipo_receita'  => 'doce',
        ]);
    }

    // Teste 1
    public function test_receita_doce_identificada_corretamente(): void
    {
        $this->assertTrue($this->receita->isDoce());
    }

    // Teste 2
    public function test_receita_nao_e_salgada_quando_doce(): void
    {
        $this->assertFalse($this->receita->isSalgada());
    }

    // Teste 3
    public function test_receita_salgada_identificada_corretamente(): void
    {
        $this->receita->tipo_receita = 'salgada';
        $this->assertTrue($this->receita->isSalgada());
    }

    // Teste 4
    public function test_receita_nao_e_doce_quando_salgada(): void
    {
        $this->receita->tipo_receita = 'salgada';
        $this->assertFalse($this->receita->isDoce());
    }

    // Teste 5
    public function test_custo_formatado_retorna_string_em_reais(): void
    {
        $this->assertEquals('R$ 99,99', $this->receita->custoFormatado());
    }

    // Teste 6
    public function test_custo_formatado_com_valor_zero(): void
    {
        $this->receita->custo = 0;
        $this->assertEquals('R$ 0,00', $this->receita->custoFormatado());
    }

    // Teste 7
    public function test_custo_formatado_com_milhar(): void
    {
        $this->receita->custo = 1234.56;
        $this->assertEquals('R$ 1.234,56', $this->receita->custoFormatado());
    }

    // Teste 8
    public function test_nome_e_atribuido_corretamente(): void
    {
        $this->assertEquals('Bolo Teste', $this->receita->nome);
    }

    // Teste 9
    public function test_constante_tipo_doce_definida(): void
    {
        $this->assertEquals('doce', Receita::TIPO_DOCE);
    }

    // Teste 10
    public function test_constante_tipo_salgada_definida(): void
    {
        $this->assertEquals('salgada', Receita::TIPO_SALGADA);
    }
}
