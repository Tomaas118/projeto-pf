@extends('layouts.dashboard')

@section('title', 'Inserir Baixa Médica')

@section('content')
<div class="container">
    <h1>Inserir Baixa Médica</h1>
    <form>
        <div class="mb-3">
            <label class="form-label">Médico</label>
            <input type="text" class="form-control" id="id_medico" name="id_medico" value="1" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Paciente</label>
            <select class="form-control" id="id_paciente" name="id_paciente" required>
                <option value="1">Paciente 1</option>
                <option value="2">Paciente 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Unidade Médica</label>
            <select class="form-control" id="id_unidadeMedica" name="id_unidadeMedica" required>
                <option value="1">Unidade Médica 1</option>
                <option value="2">Unidade Médica 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Diagnóstico</label>
            <input type="text" class="form-control" id="diagnostico" name="diagnostico" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Fim</label>
            <input type="date" class="form-control" id="dataFim" name="dataFim" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Recomendações</label>
            <textarea class="form-control" id="recomendacoes" name="recomendacoes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Criar Baixa Médica</button>
    </form>
</div>
@endsection