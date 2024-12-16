@extends('layouts.dashboard')

@section('title', 'Inserir Baixa Médica')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="container">
    <h1>Inserir Baixa Médica</h1>
    <form action="{{ route('insertBaixasMedicas') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Médico</label>
            <input type="text" class="form-control" id="id_medico" name="id_medico" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Cartão de Cidadão</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="cartao_cidadao_input" name="cartao_cidadao_input">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Paciente</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="paciente_name" name="paciente_name" readonly>
                    <input type="hidden" id="paciente_select" name="id_paciente">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Unidade Médica</label>
                <div class="input-group">
                    <select class="form-control" id="unidade_medica_select" name="id_unidadeMedica">
                        @foreach($unidadesMedicas as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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

<script>
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    document.getElementById('cartao_cidadao_input').addEventListener('input', debounce(function() {
        var cartao = this.value;
        fetch(`/api/paciente/${cartao}`)
            .then(response => response.json())
            .then(data => {
                if (data.paciente) {
                    document.getElementById('paciente_name').value = data.paciente.nome;
                    document.getElementById('paciente_select').value = data.paciente.id;
                }
            });
    }, 550));
</script>
@endsection