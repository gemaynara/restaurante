<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'empresa_id',
        'categoria_produto_id',
        'nome',
        'descricao',
        'unidade',
        'estoque',
        'estoque_min',
        'estoque_max',
        'lote',
        'valor'
    ];
    protected $appends = ['estoque'];

    public function getEstoqueAttribute()
    {
        if ($this->attributes['unidade'] == 'KG' || $this->attributes['unidade'] == 'G') {
            return$this->attributes['estoque'];
        } else {
            return (int)$this->attributes['estoque'];
        }
    }

    public static function medidas()
    {
        return [
            ['key' => "BL", 'value' => 'Bloco'],
            ['key' => "CX", 'value' => 'Caixa'],
            ['key' => "CT", 'value' => 'Cento'],
            ['key' => "FA", 'value' => 'Fardo'],
            ['key' => "G", 'value' => 'Grama'],
            ['key' => "GL", 'value' => 'Galão'],
            ['key' => "KG", 'value' => 'Kilograma'],
            ['key' => "LT", 'value' => 'Lata'],
            ['key' => "L", 'value' => 'Litro'],
            ['key' => "PC", 'value' => 'Pacote'],
            ['key' => "RO", 'value' => 'Rolo'],
            ['key' => "SA", 'value' => 'Sachê'],
            ['key' => "UND", 'value' => 'Unidade']
        ];
    }

    public function categoriasProduto()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_produto_id');
    }
}
