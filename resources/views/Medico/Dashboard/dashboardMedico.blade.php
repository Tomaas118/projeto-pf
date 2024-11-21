@extends('layouts.dashboard')

@section('title', 'Dashboard Médico')

@section('sidenav-content')
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
@endsection

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="section functionality-section">
        <div class="section-content">
            <div class="row">
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="{{ route('insertBaixasMedicas') }}">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-file-prescription"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Baixas Temporárias</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="las la-user-md"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Section 2</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="las la-user-plus"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Section 3</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="card text-center card-custom" href="#">
                        <div class="card-body">
                            <div class="icon-wrapper"><i class="fa-solid fa-house-chimney-medical"></i></div>
                        </div>
                        <div class="card-title">
                            <p>Section 4</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-custom {
        background-color: #c31f2a;
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
        background-color: #a51a23;
        color: white;
    }
    .icon-wrapper {
        font-size: 36px;
        margin-bottom: 10px;
    }
</style>
@endsection