<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mesa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mesas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'empresa_id',
        'codigo',
        'situacao',
        'ativo'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class)->orderBy('id', 'desc');
    }
}
