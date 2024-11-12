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

    public function registarUser(Request $request){

        // dd($request['nome']);
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:medicos,username', 
            'email' => 'required|email|unique:medicos,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);

        // // Redireciona para uma página de sucesso ou de login
        // return redirect()->route('some_success_route')->with('success', 'Médico registado com sucesso!');
    }

    public function storeUser(Request $request)
    {
        $userData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        session()->put('user_data', $userData);

        return redirect()->route('registarPaciente');
    }

    public function registar(Request $request)
    {

        $pacienteData = $request->validate([
            'nome' => 'required|string|max:255',
            'morada' => 'required|string|max:255',
            'n_cidadao' => 'required|string|min:8|max:8|unique:pacientes,n_cidadao',
            'data_nascimento' => 'required|date|before:today|after:1900-01-01',
            'n_nacionalSaude' => 'required|string|min:9|max:9|unique:pacientes,n_nacionalSaude',
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

        return redirect()->route('paginaSucesso')->with('message', 'Usuário e paciente registados com sucesso!');
    }
}
