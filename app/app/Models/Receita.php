<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receita extends Model
{
    use HasFactory;

    protected $table = 'receitas';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'descricao',
        'data_registro',
        'custo',
        'tipo_receita',
    ];

    protected $casts = [
        'data_registro' => 'date',
        'custo' => 'decimal:2',
    ];

    const TIPO_DOCE = 'doce';
    const TIPO_SALGADA = 'salgada';

    public function isDoce(): bool
    {
        return $this->tipo_receita === self::TIPO_DOCE;
    }

    public function isSalgada(): bool
    {
        return $this->tipo_receita === self::TIPO_SALGADA;
    }

    public function custoFormatado(): string
    {
        return 'R$ ' . number_format((float) $this->custo, 2, ',', '.');
    }
}
