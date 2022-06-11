<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleCaixa extends Model
{
    use HasFactory;

    protected $table = 'controle_caixa';

    protected $fillable = [
        'empresa_id',
        'saldo_anterior',
        'valor_inicial',
        'valor_final',
        'saldo_quebra',
        'saldo_falta',
        'entradas',
        'saidas',
        'status',
        'observacoes',
    ];
}
