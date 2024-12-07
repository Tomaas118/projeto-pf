@extends('layouts.dashboard')

@section('title', 'Inserir Baixa Médica')

@section('content')
<div class="container">
    <h1>Inserir Baixa Médica</h1>
    <form>
        <div class="mb-3">
            <label class="form-label">Médico</label>
            <input type="text" class="form-control" id="id_medico" name="id_medico" value="Dr. John Doe" readonly>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Cartão de Cidadão</label>
                <div class="input-group">
                    <select class="form-control combobox" id="cartao_cidadao_select" name="cartao_cidadao_select">
                        <option value="123456789">123456789</option>
                        <option value="987654321">987654321</option>
                        <option value="456789123">456789123</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Paciente</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="paciente_name" name="paciente_name" readonly>
                    <input type="hidden" id="paciente_select" name="paciente_select">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Unidade Médica</label>
                <div class="input-group">
                    <select class="form-control combobox" id="unidade_medica_select" name="unidade_medica_select">
                        <option value="1">Hospital Santa Maria</option>
                        <option value="2">Clinica Boa Saúde</option>
                        <option value="3">Centro Médico São José</option>
                        <option value="4">Hospital das Flores</option>
                        <option value="5">Unidade de Saúde Familiar</option>
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
    document.getElementById('cartao_cidadao_select').addEventListener('change', function() {
        var selectedCartao = this.value;
        var pacienteSelect = document.getElementById('paciente_select');
        var pacienteName = document.getElementById('paciente_name');
        
        var pacienteOptions = {
            "123456789": {id: 1, name: "João Silva"},
            "987654321": {id: 2, name: "Maria Santos"},
            "456789123": {id: 3, name: "José Pereira"}
        };
        
        if (pacienteOptions[selectedCartao]) {
            pacienteSelect.value = pacienteOptions[selectedCartao].id;
            pacienteName.value = pacienteOptions[selectedCartao].name;
        } else {
            pacienteSelect.value = '';
            pacienteName.value = '';
        }
    });
</script>
@endsection