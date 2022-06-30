<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
        return view('pages.delivery.cadastro.index');
    }
}
