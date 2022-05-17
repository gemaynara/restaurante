<?php

namespace App\Http\Controllers\App;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\EmpresaParametros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login($slug)
    {
        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        return view('pages.app.auth.login', compact('restaurante'));
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1, 'type' => 'client'])) {
            return redirect()->intended( "app/".$request->slug.'/principal')->with('slug', $request->slug);
        }

        return back()
            ->withErrors(['email' => trans('auth.failed')])
            ->withInput(request(['email']));
    }

    public function register($slug)
    {
        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        return view('pages.app.auth.register', compact('restaurante'));
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::create([
            'username' => Helper::generateUsername($request->name),
            'name' => $request->name,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'client',
            'empresa_id' => $request->restaurante_id
        ]);

        Auth::login($user);
        return redirect()->route('app.home', $request->slug);
    }
}
