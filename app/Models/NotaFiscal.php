<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;

    protected $table = 'notas_fiscais';

    protected $fillable = [
        'empresa_id',
        'fornecedor_id',
        'usuario_id',
        'numero_nota',
        'natureza',
        'valor_total',
        'valor_frete',
        'valor_desconto',
        'situacao',
    ];

    public function fornecedores(){
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function detalhes(){
        return $this->hasMany(ProdutosNotaFiscal::class, 'nota_fiscal_id')
            ->with('produtos');
    }
}
