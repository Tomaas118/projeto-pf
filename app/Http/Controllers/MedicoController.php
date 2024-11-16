<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medico;
use App\Models\UnidadesMedicas;
use App\Models\MedicoUnidadeMedica;
    

class MedicoController extends Controller
{
    public function login(Request $request){
        
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        session([
            'medico_user_name' => $request->name,
            'medico_user_email' => $request->email,
            'medico_user_password' => bcrypt($request->password),
        ]);



        return redirect()->route('registarMedico');
    }

    public function storeMedico(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'morada' => 'required|string|max:255',
            'telemovel' => 'required|min:9|max:9',
            'n_cidadao' => 'required|min:8|max:8',
            'especialidade' => 'required|string|max:255',
        ]);

        session([
            'medico_nome' => $request->nome,
            'medico_morada' => $request->morada,
            'medico_telemovel' => $request->telemovel,
            'medico_n_cidadao' => $request->n_cidadao,
            'medico_especialidade' => $request->especialidade,
        ]);

        return redirect()->route('registarMedicoUnidadesMedicas');
    }

    public function registar(Request $request)
    {
        $unidades = $request->only(['unidade_nome', 'unidade_morada', 'unidade_setor', 'unidade_ativo']);

        $unidades = array_map(function($nome, $morada, $setor, $ativo) {
            return [
                'nome' => $nome,
                'morada' => $morada,
                'setor' => $setor,
                'ativo' => $ativo ? 1 : 0,
            ];
        }, $unidades['unidade_nome'], $unidades['unidade_morada'], $unidades['unidade_setor'], $unidades['unidade_ativo']?? []);
        
        $unidades = array_filter($unidades, function($grupo) {
            return isset($grupo['nome'], $grupo['morada'], $grupo['setor'])
                && $grupo['nome'] !== null && $grupo['nome'] !== ''
                && $grupo['morada'] !== null && $grupo['morada'] !== ''
                && $grupo['setor'] !== null && $grupo['setor'] !== '';
        });
        
        session([
            'unidades_medicas' => $unidades,
        ]);

        $this->registarTotal();


        return redirect()->route('loginMedico')->with('success', 'Médico registado com sucesso!');
    }

    public function registarTotal(){
        $userData = session()->only(['medico_user_name', 'medico_user_email', 'medico_user_password']);
        $medicoData = session()->only(['medico_nome', 'medico_morada', 'medico_telemovel', 'medico_n_cidadao', 'medico_especialidade']);
        $unidadesMedicas = session('unidades_medicas');

        $user = User::create([
            'name' => $userData['medico_user_name'],
            'email' => $userData['medico_user_email'],
            'password' => $userData['medico_user_password'],
        ]);

        $medico = Medico::create([
            'id_user' => $user->id,
            'nome' => $medicoData['medico_nome'],
            'morada' => $medicoData['medico_morada'],
            'telemovel' => $medicoData['medico_telemovel'],
            'n_cidadao' => $medicoData['medico_n_cidadao'],
            'especialidade' => $medicoData['medico_especialidade'],
        ]);

        foreach ($unidadesMedicas as $unidadeMedica) {
            $unidade = UnidadesMedicas::create([
                'nome' => $unidadeMedica['nome'],
                'morada' => $unidadeMedica['morada'],
                'setor' => $unidadeMedica['setor'],
            ]);

            $medico->unidadesMedicas()->attach($unidade->id, ['ativo' => isset($unidadeMedica['ativo']) ? 1 : 0]);
        }

        session()->flush();
    }

}