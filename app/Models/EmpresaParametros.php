<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaParametros extends Model
{
    use HasFactory;

    protected $table = 'empresa_parametros';

    protected $fillable = [
        'empresa_id',
        'logo',
        'gorjeta',
        'taxa_entrega',
        'latitude',
        'longitude'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
