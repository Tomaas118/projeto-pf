@extends('layouts.loginRegisto')

@section('title', 'Registar Medico')

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
  <form action="{{ route('registarMedico') }}" method="POST">
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
      <label for="telemovel" class="form-label">Telemóvel</label>
      <input type="number" class="form-control" id="telemovel" name="telemovel" required minlength="9" maxlength="9" placeholder="Coloque o seu numero de telemovel">
    </div>
    <div class="mb-3">
      <label for="n_cidadao" class="form-label">Nº Cartão de Cidadão</label>
      <input type="number" class="form-control" id="n_cidadao" name="n_cidadao" required minlength="8" maxlength="8" placeholder="Coloque os primeiros 8 numeros do cartao de cidadão">
    </div>
    <div class="mb-3">
      <label for="especialidade" class="form-label">Especialidade</label>
      <input type="text" class="form-control" id="especialidade" name="especialidade" required placeholder="Coloque a sua especialidade">
    </div>

    <button type="submit" class="btn btn-primary">continuar</button>

  </form>
@endsection



