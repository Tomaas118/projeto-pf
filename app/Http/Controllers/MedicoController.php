<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medico;
use App\Models\UnidadesMedicas;
use App\Models\MedicoUnidadeMedica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BaixaMedica;
use App\Models\Paciente;

class MedicoController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_or_email' => 'required',
            'password' => 'required|min:8',
        ], [
            'user_or_email.required' => 'O campo de usuário ou email é obrigatório.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter no mínimo 8 caracteres.',
        ]);

        $loginField = $credentials['user_or_email'];

        if (str_contains($loginField, '@')) {
            $authCredentials = [
                'email' => $loginField,
                'password' => $credentials['password']
            ];
        } else {
            $authCredentials = [
                'name' => $loginField,
                'password' => $credentials['password']
            ];
        }

        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $isMedico = DB::table('medicos')->where('id_user', $user->id)->exists();

            if ($isMedico) {
                return redirect()->intended('Medico/Dashboard');
            } else {
                $isPaciente = DB::table('pacientes')->where('id_user', $user->id)->exists();

                if ($isPaciente) {
                    return redirect()->intended('Paciente/Dashboard');
                }
            }

            Auth::logout();
            return back()->withErrors([
                'user_or_email' => 'Você não tem permissão para acessar o sistema.',
            ]);
        }

        return back()->withErrors([
            'user_or_email' => 'As credenciais estão incorretas.',
        ]);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'O campo de nome de usuário é obrigatório.',
            'name.max' => 'O campo só suporta 255 caracters.',
            'email.required' => 'O email é obrigatória.',
            'email.email' => 'Não colocou um email.',
            'email.max' => 'O campo só suporta 255 caracters.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter no mínimo 8 caracteres.',
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
            'nome' => 'required|max:255',
            'morada' => 'required|max:255',
            'telemovel' => 'required|min:9|max:9',
            'n_cidadao' => [
                'required',
                'min:8',
                'max:8',
                function ($attribute, $value, $fail) {
                    if (DB::table('medicos')->where('n_cidadao', $value)->exists() || DB::table('pacientes')->where('n_cidadao', $value)->exists()) {
                        $fail('Esse numero de cidadão já existe.');
                    }
                },
            ],
            'especialidade' => 'required|max:255',
        ], [
            'nome.required' => 'O campo de nome é obrigatório.',
            'nome.max' => 'O campo só suporta 255 caracters.',
            'morada.required' => 'O campo morada é obrigatória.',
            'morada.max' => 'O campo só suporta 255 caracters.',
            'n_cidadao.required' => 'O numero de cidadão é obrigatório.',
            'n_cidadao.min' => 'O numero de cidadão tem que ter exatamente 8 numeros.',
            'n_cidadao.max' => 'O numero de cidadão tem que ter exatamente 8 numeros.',
            'n_cidadao.unique' => 'Esse numero de cidadão já existe',
            'telemovel.required' => 'A password é obrigatória.',
            'telemovel.min' => 'O campo deve ter exatamente 9 numeros.',
            'telemovel.max' => 'O campo deve ter exatamente 9 numeros.',
            'especialidade.required' => 'O campo especialidade é obrigatória.',
            'especialidade.max' => 'O campo só suporta 255 caracters.',
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
        }, $unidades['unidade_nome'], $unidades['unidade_morada'], $unidades['unidade_setor'], $unidades['unidade_ativo']);

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

    public function registarTotal()
    {
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

            $medico->unidadesMedicas()->attach($unidade->id, ['ativo' => $unidadeMedica['ativo']]);
        }

        session()->flush();
    }

    public function getPaciente($cartao_cidadao)
    {
        $paciente = Paciente::where('n_cidadao', $cartao_cidadao)->first();
        return response()->json(['paciente' => $paciente]);
    }

    public function insertBaixasMedicas(Request $request)
    {
        $request->validate([
            'id_medico' => 'required',
            'id_paciente' => 'required',
            'id_unidadeMedica' => 'required',
            'cartao_cidadao_input' => 'required',
            'diagnostico' => 'required',
            'dataInicio' => 'required|date|after_or_equal:today',
            'dataFim' => 'required|date|after_or_equal:dataInicio',
            'recomendacoes' => 'nullable'
        ]);

        $medico = Medico::where('id_user', Auth::id())->first();
        $medicoId = $medico['id'];

        BaixaMedica::create([
            'id_medico' => $medicoId,
            'id_paciente' => $request->id_paciente,
            'id_unidadeMedica' => $request->id_unidadeMedica,
            'id_ncidadao' => $request->cartao_cidadao_input,
            'diagnostico' => $request->diagnostico,
            'dataInicio' => $request->dataInicio,
            'dataFim' => $request->dataFim,
            'recomendacoes' => $request->recomendacoes
        ]);

        return redirect()->route('inserirBaixas')->with('success', 'Baixa médica criada com sucesso!');
    }

    public function showUnidadesMedicasForm()
    {
        $medico = Medico::where('id_user', Auth::id())->first();
        $unidadesMedicas = $medico->unidadesMedicas;

        return view('Medico.InsertBaixasMedicas', compact('unidadesMedicas'));
    }

    public function verBaixasTemporarias()
    {
        $userId = Auth::id();
        $medicoId = Medico::where('id_user', $userId)->first();
        $medicoId = $medicoId["id"];

        $baixas = BaixaMedica::where('id_medico', $medicoId)->get();
    
        return view('Medico.verBaixas', compact('baixas'));    
    }

    public function verEditarBaixa($id)
    {
        $baixa = BaixaMedica::findOrFail($id);
        $medico = Medico::where('id_user', Auth::id())->first();
        $unidadesMedicas = $medico->unidadesMedicas;

        return view('Medico.editarBaixasMedicas', compact('baixa', 'unidadesMedicas'));
    }

    public function editarBaixa(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnostico' => 'required|string',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date',
            'id_unidadeMedica' => 'required|exists:unidades_medicas,id',
        ]);

        $baixa = BaixaMedica::findOrFail($id);
        $baixa->update($validated);

        return redirect()->route('baixas')->with('success', 'Baixa Médica atualizada com sucesso!');
    }

    public function eliminarBaixa($id)
    {
        $baixa = BaixaMedica::findOrFail($id);
        $baixa->delete();
        return redirect()->route('baixas')->with('success', 'Baixa médica eliminada');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}