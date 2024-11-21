<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function login(Request $request){
        
    }

    public function storeUser(Request $request)
    {
        $userData = $request->validate([
            'name' => 'required|max:255|unique:users,name', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'O campo de nome de usuario é obrigatório.',
            'name.max' => 'O campo só suporta 255 caracters.',
            'name.unique' => 'O nome de usuario já existe',
            'email.required' => 'O campo morada é obrigatória.',
            'email.email' => 'O campo email nao é um email',
            'email.unique' => 'O email já existe',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'O campo password deve ter no minimo 8 caracters.',
        ]);

        session()->put('user_data', $userData);

        return redirect()->route('registarPaciente');
    }

    public function registar(Request $request)
    {

        $pacienteData = $request->validate([
            'nome' => 'required|max:255',
            'morada' => 'required|max:255',
            'n_cidadao' => 'required|min:8|max:8|unique:pacientes,n_cidadao',
            'data_nascimento' => 'required|before:today|after:1900-01-01',
            'n_nacionalSaude' => 'required|min:9|max:9|unique:pacientes,n_nacionalSaude',
        ], [
            'nome.required' => 'O campo de nome é obrigatório.',
            'nome.max' => 'O campo nome só suporta 255 caracters.',
            'morada.required' => 'O campo morada é obrigatória.',
            'morada.max' => 'O campo morada só suporta 255 caracters.',
            'n_cidadao.required' => 'O numero de cidadão é obrigatórioé obrigatório',
            'n_cidadao.min' => 'O numero de cidadão tem que ter exatamente 8 numeros.',
            'n_cidadao.max' => 'O numero de cidadão tem que ter exatamente 8 numeros.',
            'n_cidadao.unique' => 'Esse numero de cidadão já existe',
            'data_nascimento.required' => 'A data é obrigatória.',
            'data_nascimento.before' => 'A data nao pode estar no futuro',
            'data_nascimento.after' => 'A data tem que ser depois de 1900-01-01',
            'n_nacionalSaude.required' => 'O campo numero nacional de saude é obrigatorio.',
            'n_nacionalSaude.min' => 'O numero nacional de saude tem que ter exatamente 9 numeros.',
            'n_nacionalSaude.max' => 'O numero nacional de saude tem que ter exatamente 9 numeros.',
            'n_nacionalSaude.unique' => 'O numero nacional de saude já existe',
        ]);

        $userData = session()->get('user_data');
        if (!$userData) {
            return redirect()->route('registarPacienteUser')->withErrors(['message' => 'Erro ao registar o utilizador.']);
        }

        DB::transaction(function () use ($userData, $pacienteData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']),
            ]);

            Paciente::create([
                'id_user' => $user->id,
                'nome' => $pacienteData['nome'],
                'morada' => $pacienteData['morada'],
                'n_cidadao' => $pacienteData['n_cidadao'],
                'data_nascimento' => $pacienteData['data_nascimento'],
                'n_nacionalSaude' => $pacienteData['n_nacionalSaude'],
            ]);
        });

        session()->forget('user_data');

        return redirect()->route('loginPaciente')->with('success', 'Utilizador registado com sucesso!');
    }
}
