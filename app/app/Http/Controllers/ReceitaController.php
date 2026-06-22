<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Receita::query();

        if ($request->filled('tipo_receita')) {
            $query->where('tipo_receita', $request->tipo_receita);
        }

        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        $receitas = $query->orderBy('data_registro', 'desc')->get();

        return view('receitas.index', compact('receitas'));
    }

    public function create()
    {
        return view('receitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'data_registro' => 'required|date',
            'custo'         => 'required|numeric|min:0',
            'tipo_receita'  => 'required|in:doce,salgada',
        ]);

        Receita::create($validated);

        return redirect()->route('receitas.index')->with('success', 'Receita cadastrada com sucesso!');
    }

    public function edit(Receita $receita)
    {
        return view('receitas.edit', compact('receita'));
    }

    public function update(Request $request, Receita $receita)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'data_registro' => 'required|date',
            'custo'         => 'required|numeric|min:0',
            'tipo_receita'  => 'required|in:doce,salgada',
        ]);

        $receita->update($validated);

        return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(Receita $receita)
    {
        $receita->delete();

        return redirect()->route('receitas.index')->with('success', 'Receita removida com sucesso!');
    }
}
