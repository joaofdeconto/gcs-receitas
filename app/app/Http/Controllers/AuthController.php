<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('receitas.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['senha']])) {
            $usuario = Auth::user();

            if (!$usuario->isAtivo()) {
                Auth::logout();
                return back()->withErrors(['login' => 'Usuário inativo. Contate o administrador.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('receitas.index'));
        }

        return back()->withErrors(['login' => 'Login ou senha inválidos.'])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
