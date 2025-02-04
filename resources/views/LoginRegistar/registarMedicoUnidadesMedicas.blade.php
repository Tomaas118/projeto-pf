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
<form action="{{ route('registarMedicoUnidadesMedicas') }}" method="POST">
  @csrf
  <div class="mb-3" id="unidade-medica-fields">
    <div class="row mb-3" id="unidade-group-1">
      <div class="col-12">
        <h6>Unidade Médica 1</h6>
      </div>
      <div class="col-6">
        <input type="text" class="form-control" id="unidade_nome_1" name="unidade_nome[]" placeholder="Nome da unidade médica" oninput="handleUnidadeInput(this)" onblur="handleUnidadeBlur(this)">
      </div>
      <div class="col-6">
        <input type="text" class="form-control" id="unidade_morada_1" name="unidade_morada[]" placeholder="Morada da unidade médica" oninput="handleUnidadeInput(this)" onblur="handleUnidadeBlur(this)">
      </div>
    </div>

    <div class="row mb-3" id="setor-checkbox-group-1">
      <div class="col-6">
        <select id="unidade_setor_1" name="unidade_setor[]" class="form-select" required>
            <option value="Publico">Público</option>
            <option value="Privada">Privada</option>
        </select>
      </div>
      <div class="col-6">
        <div class="form-check">
          <input type="hidden" name="unidade_ativo[1]" value="0">
          <input type="checkbox" class="form-check-input" id="unidade_ativo_1" name="unidade_ativo[1]" value="1" checked>
          <label class="form-check-label" for="unidade_ativo_1">Ainda trabalha lá</label>
        </div>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Registar</button>
</form>

<script>
  function handleUnidadeInput(currentInput) {
    const unidadeFields = document.querySelectorAll('[id^="unidade_nome_"]'); 
    const currentIndex = getCurrentIndex(currentInput);

    if (currentInput.value !== "" && unidadeFields.length === currentIndex) {
      createNewUnidadeInput(currentIndex + 1); 
    }
  }

  function handleUnidadeBlur(currentInput) {
    const currentIndex = getCurrentIndex(currentInput); 

    if (areAllFieldsEmpty(currentIndex)) {
      removeNextGroup(currentIndex);
    }

  }

  function areAllFieldsEmpty(groupIndex) {
    const nomeField = document.getElementById(`unidade_nome_${groupIndex}`);
    const moradaField = document.getElementById(`unidade_morada_${groupIndex}`);

    return !nomeField.value && !moradaField.value;
  }

  function removeNextGroup(groupIndex) {
    groupIndex++;
    console.log(groupIndex);
    const currentGroup = document.getElementById(`unidade-group-${groupIndex}`);
    const currentSetorCheckboxGroup = document.getElementById(`setor-checkbox-group-${groupIndex}`);
    currentGroup.remove();
    currentSetorCheckboxGroup.remove();
  }


  function getCurrentIndex(input) {
    const idParts = input.id.split('_');
    return parseInt(idParts[idParts.length - 1]);
  }

  function createNewUnidadeInput(index) {
    const newNomeInput = createInputField('unidade_nome', index, 'Nome da unidade médica');
    const newMoradaInput = createInputField('unidade_morada', index, 'Morada da unidade médica');
    const newSetorInput = createInputField('unidade_setor', index, 'Setor da unidade médica');
    const newCheckbox = createCheckboxField(index);

    const row1 = createRow([newNomeInput, newMoradaInput]);

    const row2 = createRow([newSetorInput, newCheckbox]);

    const unidadeGroup = document.createElement('div');
    unidadeGroup.classList.add('mb-3');
    unidadeGroup.id = `unidade-group-${index}`; 
    const label = document.createElement('h6');
    label.textContent = `Unidade Médica ${index}`;
    if(index==2){
      unidadeGroup.appendChild(createSeparator());
    }
    unidadeGroup.appendChild(label); 
    unidadeGroup.appendChild(row1); 
    unidadeGroup.appendChild(row2); 
    unidadeGroup.appendChild(createSeparator());

    document.getElementById('unidade-medica-fields').appendChild(unidadeGroup);
  }

  function createInputField(namePrefix, index, placeholder) {
    if (namePrefix === 'unidade_setor') {
        const select = document.createElement('select');
        select.classList.add('form-select');
        select.name = `${namePrefix}[]`;
        select.id = `${namePrefix}_${index}`;
        select.setAttribute('required', true);
        select.setAttribute('oninput', 'handleUnidadeInput(this)');
        select.setAttribute('onblur', 'handleUnidadeBlur(this)');

        const optionPublico = document.createElement('option');
        optionPublico.value = 'Publico';
        optionPublico.textContent = 'Público';

        const optionPrivada = document.createElement('option');
        optionPrivada.value = 'Privada';
        optionPrivada.textContent = 'Privada';

        select.appendChild(optionPublico);
        select.appendChild(optionPrivada);

        return select;
    } else {
        const input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control');
        input.placeholder = placeholder;
        input.name = `${namePrefix}[]`;
        input.id = `${namePrefix}_${index}`;
        input.setAttribute('oninput', 'handleUnidadeInput(this)');
        input.setAttribute('onblur', 'handleUnidadeBlur(this)');
        return input;
    }
  } 

  function createCheckboxField(index) {
    const checkboxDiv = document.createElement('div');
    checkboxDiv.classList.add('form-check');
    
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = `unidade_ativo[${index}]`;
    hiddenInput.value = '0';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.classList.add('form-check-input');
    checkbox.id = `unidade_ativo_${index}`;
    checkbox.name = `unidade_ativo[${index}]`;
    checkbox.value = '1';
    checkbox.checked = true;

    const label = document.createElement('label');
    label.classList.add('form-check-label');
    label.setAttribute('for', `unidade_ativo_${index}`);
    label.textContent = 'Ainda trabalha lá';

    checkboxDiv.appendChild(hiddenInput);
    checkboxDiv.appendChild(checkbox);
    checkboxDiv.appendChild(label);
    return checkboxDiv;
  }

  function createRow(inputs) {
    const row = document.createElement('div');
    row.classList.add('row', 'mb-3');
    inputs.forEach(input => {
      const col = document.createElement('div');
      col.classList.add('col-6');
      col.appendChild(input);
      row.appendChild(col);
    });
    return row;
  }

  function createSeparator() {
    const separator = document.createElement('hr');
    separator.classList.add('my-4');
    return separator;
  }
</script>

@endsection
