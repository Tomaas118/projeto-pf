@extends('layouts.loginRegisto')

@section('title', 'Registar Paciente')

@section('content')
    <h5>Coloque os dados para criar um usuario</h5>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registarPacienteUser') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome de usuário</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Ex:(Paciente123)">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Ex:(Paciente123@gmail.com)">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="No minimo 8 caracters">
        </div>
        
        <p class="mb-3">Já tem conta? <a href="/Login-Paciente" class="text-primary">Login</a></p>

        <button type="submit" class="btn btn-primary">Registar</button>
    </form>
@endsection
