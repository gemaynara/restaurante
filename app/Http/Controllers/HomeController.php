<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\CategoriaCardapio;
use App\Models\EmpresaParametros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->type == 'employee') {
            return view('pages.dashboard');
        } elseif (auth()->user()->type == 'client') {
            Session::flush();
            Auth::logout();
            return Redirect('/');
        }
    }

}
