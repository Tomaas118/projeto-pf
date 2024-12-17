@extends('layouts.dashboard')

@section('title', 'Dashboard Médico')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="section functionality-section">
        <div class="section-content">
            <div class="row">
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="Baixas-temporarias">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-file-prescription"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Inserir Baixas Temporárias</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-file-medical"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Ver Baixas Emitidas</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-hospital"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Gerir Centro Hospitalar</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-file-pdf"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Gerar PDF</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-custom {
        background-color: #0d6efd;
        color: white;
        font-size: 18px;
        height: 180px;
        width: 240px;
        margin: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    }
    .card-custom:hover {
        background-color: #0b5ed7;
        color: white;
    }
    .icon-wrapper {
        font-size: 36px;
        margin-bottom: 10px;
    }
</style>
@endsection