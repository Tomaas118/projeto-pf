@extends('layouts.loginRegisto')

@section('title', 'Registar Medico')

@section('content')
    <form action="{{ route('registarMedico') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nome de usuário</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nº Cartão de Cidadão</label>
            <input type="text" class="form-control" id="username" name="username" required pattern="\d{1,8}" maxlength="8" title="Apenas números (máximo 8 dígitos)">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <p class="mb-3">Já tem conta? <a href="/Login-Medico" class="text-primary">Login</a></p>

        <button type="submit" class="btn btn-primary">Registar</button>
    </form>
@endsection
