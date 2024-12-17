@extends('layouts.dashboard')

@section('title', 'Dashboard Médico')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>
    <div class="section functionality-section">
        <div class="row">

            <div class="col-md-3 mb-4">
                <a href="Baixas-temporarias" class="text-decoration-none">
                    <div class="card bg-primary text-white text-center h-150 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-file-prescription fa-2x mb-2"></i>
                            </div>
                            <p class="card-title mb-0">Inserir Baixas Temporárias</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-primary text-white text-center h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-file-medical fa-2x mb-2"></i>
                            </div>
                            <p class="card-title mb-0">Ver Baixas Emitidas</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-primary text-white text-center h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-hospital fa-2x mb-2"></i>
                            </div>
                            <p class="card-title mb-0">Gerir Centro Hospitalar</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-primary text-white text-center h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-file-pdf fa-2x mb-2"></i>
                            </div>
                            <p class="card-title mb-0">Gerar PDF</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .icon-wrapper i {
        font-size: 36px;
    }
    .card {
        min-height: 150px;
        transition: background-color 0.3s ease;
    }
    .card:hover {
        background-color: #0b5ed7; /* Tom de azul mais escuro no hover */
    }
</style>

@endsection