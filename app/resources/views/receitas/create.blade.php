@extends('layouts.app')

@section('title', 'Nova Receita')

@section('content')
<style>
    .form-card { background: #1e293b; border-radius: 10px; padding: 32px; max-width: 600px; }
    .form-card h1 { font-size: 1.5rem; margin-bottom: 24px; }
    label { display: block; font-size: 0.875rem; color: #94a3b8; margin-bottom: 6px; margin-top: 16px; }
    input, textarea, select { width: 100%; padding: 10px 14px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #e2e8f0; font-size: 0.95rem; }
    textarea { resize: vertical; min-height: 80px; font-family: inherit; }
    .form-actions { margin-top: 28px; display: flex; gap: 12px; }
</style>

<div class="form-card">
    <h1>Nova Receita</h1>
    <form action="{{ route('receitas.store') }}" method="POST">
        @csrf

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>

        <label for="data_registro">Data de Registro</label>
        <input type="date" id="data_registro" name="data_registro" value="{{ old('data_registro', date('Y-m-d')) }}" required>

        <label for="custo">Custo (R$)</label>
        <input type="number" step="0.01" min="0" id="custo" name="custo" value="{{ old('custo') }}" required>

        <label for="tipo_receita">Tipo</label>
        <select id="tipo_receita" name="tipo_receita" required>
            <option value="">Selecione...</option>
            <option value="doce" {{ old('tipo_receita') === 'doce' ? 'selected' : '' }}>Doce</option>
            <option value="salgada" {{ old('tipo_receita') === 'salgada' ? 'selected' : '' }}>Salgada</option>
        </select>

        <div class="form-actions">
            <button type="submit" class="btn">Salvar</button>
            <a href="{{ route('receitas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
