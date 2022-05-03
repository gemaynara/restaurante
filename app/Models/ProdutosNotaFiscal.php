<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosNotaFiscal extends Model
{
    use HasFactory;

    protected $table = 'produtos_notas_fiscais';

    protected $fillable = [
        'nota_fiscal_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'subtotal',
        'validade',
        'lote'
    ];


    public function produtos(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
