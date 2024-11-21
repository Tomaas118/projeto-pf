@extends('layouts.loginRegisto')

@section('title', 'Registar Paciente')

@section('content')
<h5>Coloque os seus dados</h5>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('registarPaciente') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Coloque o seu nome">
  </div>
  <div class="mb-3">
    <label for="morada" class="form-label">Morada</label>
    <input type="text" class="form-control" id="morada" name="morada" required placeholder="Coloque a sua morada">
  </div>
  <div class="mb-3">
    <label for="n_cidadao" class="form-label">Nº Cartão de Cidadão</label>
    <input type="number" class="form-control" id="n_cidadao" name="n_cidadao" required minlength="8" maxlength="8" placeholder="Coloque os primeiros 8 numeros do cartao de cidadão">
  </div>
  <div class="mb-3">
    <label for="n_nacionalSaude" class="form-label">Nº Utente de saude</label>
    <input type="number" class="form-control" id="n_nacionalSaude" name="n_nacionalSaude" required minlength="9" maxlength="9" placeholder="Coloque os 9 numeros do Utente de saude">
  </div>
  <div class="mb-3">
    <label for="data_nascimento" class="form-label">Data de nascimento</label>
    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required min="1900-01-01" max="{{ date('Y-m-d') }}">
  </div>

  <button type="submit" class="btn btn-primary">Registar</button>
</form>
@endsection