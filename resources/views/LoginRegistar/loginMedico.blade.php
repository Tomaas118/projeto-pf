@extends('layouts.loginRegisto')

@section('title', 'Login Médico')

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
    <form action="{{ route('loginMedico') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_or_email" class="form-label">Nome de usuário/Email</label>
            <input type="text" class="form-control" id="user_or_email" name="user_or_email" required placeholder="Coloque seu nome de usuario ou Email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Coloque a sua password">
        </div>
        
        <p class="mb-3">Ainda não tem conta? <a href="/Registar-Medico-User" class="text-primary">Registar</a></p>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
