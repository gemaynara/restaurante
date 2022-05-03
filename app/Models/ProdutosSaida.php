<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosSaida extends Model
{
    use HasFactory;

    protected $table = 'produtos_saidas';

    protected $fillable = [
        'saida_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'subtotal'
    ];

    public function produtos(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
