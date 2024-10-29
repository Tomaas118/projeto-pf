@extends('layouts.loginRegisto')

@section('title', 'Login Paciente')

@section('content')
    <form action="{{ route('loginPaciente') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user/Numero" class="form-label">Nome de usuário/Nº Cartão de cidadão</label>
            <input type="text" class="form-control" id="user/Numero" name="user/Numero" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <p class="mb-3">Ainda não tem conta? <a href="/Registar-Paciente" class="text-primary">Registar</a></p>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
