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
                        <th>#</th>
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
                            <td>{{ $baixa->id }}</td>
                            <td>{{ $baixa->paciente->nome }}</td>
                            <td>{{ $baixa->medico->nome }}</td>
                            <td>{{ $baixa->unidadeMedica->nome }}</td>
                            <td>{{ $baixa->diagnostico }}</td>
                            <td>{{ \Carbon\Carbon::parse($baixa->dataInicio)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($baixa->dataFim)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('verEditarBaixa', $baixa->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                
                                <form action="{{ route('eliminarBaixa', $baixa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
