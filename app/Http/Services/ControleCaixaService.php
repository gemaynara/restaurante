<?php

namespace App\Http\Services;

use App\Models\ControleCaixa;
use Illuminate\Support\Facades\Log;

class ControleCaixaService
{
    public static function getCaixa(){
        $caixa = ControleCaixa::query()->where('empresa_id', auth()->user()->empresa->id)
            ->where('status', 'A')
            ->orderBy('id', 'desc')
            ->first();

        if (!empty($caixa)){
            return $caixa;
        }
        Log::info('Caixa fechado para operações');
        return false;
    }

}
