@extends('layouts.loginRegisto')

@section('title', 'Login Paciente')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('loginPaciente') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_or_email" class="form-label">Nome de usuário/Email</label>
            <input type="text" class="form-control" id="user_or_email" name="user_or_email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <p class="mb-3">Ainda não tem conta? <a href="/Registar-Paciente-User" class="text-primary">Registar</a></p>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
