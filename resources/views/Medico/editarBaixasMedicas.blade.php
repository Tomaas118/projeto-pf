@extends('layouts.dashboard')

@section('title', 'Editar Baixa Médica')

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white">
            <h1 class="mb-0">Editar Baixa Médica</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <form action="{{ route('EditarBaixa', $baixa->id) }}" method="POST">
                @csrf

                <input type="hidden" class="form-control-plaintext" id="id_medico" name="id_medico" value="{{ Auth::user()->name }}" readonly>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cartão de Cidadão</label>
                        <input type="text" class="form-control" id="cartao_cidadao_input" name="cartao_cidadao_input" value="{{ $baixa->id_ncidadao }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Paciente</label>
                        <input type="text" class="form-control" id="paciente_name" name="paciente_name" value="{{ $baixa->paciente->nome }}" readonly>
                        <input type="hidden" id="paciente_select" name="id_paciente" value="{{ $baixa->id_paciente }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unidade Médica</label>
                        <select class="form-control" id="unidade_medica_select" name="id_unidadeMedica">
                            @foreach($unidadesMedicas as $unidade)
                                <option value="{{ $unidade->id }}" {{ $unidade->id == $baixa->id_unidadeMedica ? 'selected' : '' }}>{{ $unidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data de Início</label>
                        <input type="date" class="form-control" id="dataInicio" name="dataInicio" value="{{ $baixa->dataInicio }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data de Fim</label>
                        <input type="date" class="form-control" id="dataFim" name="dataFim" value="{{ $baixa->dataFim }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnóstico</label>
                    <input type="text" class="form-control" id="diagnostico" name="diagnostico" value="{{ $baixa->diagnostico }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Recomendações</label>
                    <textarea class="form-control" id="recomendacoes" name="recomendacoes">{{ $baixa->recomendacoes }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Baixa Médica</button>
            </form>
        </div>
    </div>
</div>

<script>
    let hoje = new Date();
    let dataFormatada = hoje.toISOString().split('T')[0];
    document.getElementById("dataInicio").value = dataFormatada;

    document.getElementById('cartao_cidadao_input').addEventListener('input', debounce(function() {
        var cartao = this.value;
        var pacienteName = document.getElementById('paciente_name').value;
        var pacienteSelect = document.getElementById('paciente_select').value;

        if(cartao.length == 8){
            fetch(`/Medico/api/paciente/${cartao}`)
                .then(response => response.json())
                .then(data => {
                    if (data.paciente) {
                        document.getElementById('paciente_name').value = data.paciente.nome;
                        document.getElementById('paciente_select').value = data.paciente.id;
                    }
                });
        } else {
            if(pacienteName != "") {
                document.getElementById('paciente_name').value = "";
                document.getElementById('paciente_select').value = "";
            }
        }
    }, 550));
</script>

@endsection
