<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'login',
        'senha',
        'situacao',
    ];

    protected $hidden = [
        'senha',
    ];

    /**
     * Laravel's Authenticatable expects "password" by default.
     * We override to use our "senha" column instead.
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getAuthPasswordName()
    {
        return 'senha';
    }

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function isAtivo(): bool
    {
        return $this->situacao === 'ativo';
    }
}
