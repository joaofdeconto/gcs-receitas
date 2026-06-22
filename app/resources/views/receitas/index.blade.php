@extends('layouts.app')

@section('title', 'Listagem de Receitas')

@section('content')
<style>
    .header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
    .header-row h1 { font-size: 1.5rem; color: #f1f5f9; }
    .filters { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .filters select, .filters input { padding: 8px 12px; background: #1e293b; border: 1px solid #334155; border-radius: 6px; color: #e2e8f0; font-size: 0.875rem; }
    table { width: 100%; border-collapse: collapse; background: #1e293b; border-radius: 10px; overflow: hidden; }
    th, td { padding: 14px 16px; text-align: left; font-size: 0.875rem; }
    th { background: #0f172a; color: #94a3b8; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; }
    tr { border-bottom: 1px solid #334155; }
    tr:last-child { border-bottom: none; }
    .tipo-badge { padding: 4px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
    .tipo-doce { background: #831843; color: #fbcfe8; }
    .tipo-salgada { background: #064e3b; color: #6ee7b7; }
    .actions { display: flex; gap: 8px; }
    .actions a, .actions button { padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; text-decoration: none; border: none; cursor: pointer; }
    .empty { text-align: center; padding: 60px 20px; color: #64748b; }
</style>

<div class="header-row">
    <h1>Receitas Cadastradas</h1>
    <a href="{{ route('receitas.create') }}" class="btn">+ Nova Receita</a>
</div>

<form method="GET" class="filters">
    <input type="text" name="busca" placeholder="Buscar por nome..." value="{{ request('busca') }}">
    <select name="tipo_receita">
        <option value="">Todos os tipos</option>
        <option value="doce" {{ request('tipo_receita') === 'doce' ? 'selected' : '' }}>Doce</option>
        <option value="salgada" {{ request('tipo_receita') === 'salgada' ? 'selected' : '' }}>Salgada</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filtrar</button>
</form>

@if ($receitas->isEmpty())
    <div class="empty">Nenhuma receita encontrada.</div>
@else
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data Registro</th>
            <th>Custo</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receitas as $receita)
        <tr>
            <td>{{ $receita->nome }}</td>
            <td>{{ Str::limit($receita->descricao, 40) }}</td>
            <td>{{ $receita->data_registro->format('d/m/Y') }}</td>
            <td>{{ $receita->custoFormatado() }}</td>
            <td><span class="tipo-badge tipo-{{ $receita->tipo_receita }}">{{ ucfirst($receita->tipo_receita) }}</span></td>
            <td class="actions">
                <a href="{{ route('receitas.edit', $receita) }}" class="btn btn-secondary">Editar</a>
                <form action="{{ route('receitas.destroy', $receita) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
