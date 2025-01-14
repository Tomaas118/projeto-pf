@extends('layouts.dashboard')

@section('title', 'Baixas medicas')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Lista de Baixas Médicas</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Unidade Médica</th>
                        <th>Diagnóstico</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baixas as $baixa)
                        <tr>
                            <td>{{ $baixa->paciente->nome }}</td>
                            <td>{{ $baixa->medico->nome }}</td>
                            <td>{{ $baixa->unidadeMedica->nome }}</td>
                            <td>{{ $baixa->diagnostico }}</td>
                            <td>{{ \Carbon\Carbon::parse($baixa->dataInicio)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($baixa->dataFim)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('verEditarBaixa', $baixa->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-baixa-id="{{ $baixa->id }}" data-paciente-nome="{{ $baixa->paciente->nome }}">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Quer mesmo eliminar a baixa do <span id="pacienteNome"></span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Sim</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var baixaId = button.data('baixa-id');
        var pacienteNome = button.data('paciente-nome');

        $('#pacienteNome').text(pacienteNome);

        var form = $('#deleteForm');
        form.attr('action', 'Eliminar-Baixa/' + baixaId);
    });
</script>
@endsection
