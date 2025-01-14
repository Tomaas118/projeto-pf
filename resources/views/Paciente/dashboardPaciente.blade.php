@extends('layouts.dashboard')

@section('title', 'Dashboard Paciente')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Lista de Baixas Médicas</h5>
        </div>
        <div class="card-body">
            @if(!isset($baixa))
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Médico</th>
                            <th>Unidade Médica</th>
                            <th>Diagnóstico</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($baixas as $baixa)
                            <tr>
                                <td>{{ $baixa->medico->nome }}</td>
                                <td>{{ $baixa->unidadeMedica->nome }}</td>
                                <td>{{ $baixa->diagnostico }}</td>
                                <td>{{ \Carbon\Carbon::parse($baixa->dataInicio)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($baixa->dataFim)->format('d-m-Y') }}</td>
                            </tr>
                            @php
                                $dataFim = \Carbon\Carbon::parse($baixa->dataFim);
                                $diasRestantes = $dataFim->diffInDays(\Carbon\Carbon::now()) * -1;
                                
                            @endphp
                            @if ($diasRestantes <= 7 && $diasRestantes > 0 )
                                <div class="alert-card">
                                    <div class="alert-content">
                                        <p><strong>{{ ceil($diasRestantes) }} dias restantes</strong></p>
                                        <p><strong>Médico:</strong> {{ $baixa->medico->nome }}</p>
                                        <p><strong>Unidade Medica:</strong> {{ $baixa->unidadeMedica->nome }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Ainda não tem baixas em seu nome.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .alert-card {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: red;
        color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        width: 250px;
    }
    .alert-content p {
        margin: 5px 0;
    }
</style>
@endsection
