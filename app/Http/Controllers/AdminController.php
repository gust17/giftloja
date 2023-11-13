<?php

namespace App\Http\Controllers;

use App\Models\Extrato;
use App\Models\Responsavel;
use App\Models\Saque;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function movimento()
    {
        $page = 'Movimentações';

        return view('loja.movimentacao', compact('page'));
    }

    public function recibo($id)
    {
        $movimento = Extrato::find($id);

        if (!$movimento) {
            session()->flash('error', 'Essa movimentação não existe');
            return redirect()->route('movimento');
        }
        if ($movimento->parceira_id != auth()->user()->parceira->parceira->id) {
            session()->flash('error', 'Acesso não permitido');
            return redirect()->route('movimento');

        }
        $page = 'Recibo';
        return view('loja.recibo', compact('movimento', 'page'));
    }

    public function newUser(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required',
            'name' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'tipo_usuario' => 'required',
        ]);

        $request['password'] = bcrypt($request['cpf']);


        $user = User::create($request->all());

        $grava = [

            'adminstrador' => $request->tipo_usuario,
            'status' => 1,
            'parceira_id' => auth()->user()->parceira->parceira_id,
            'user_id' => $user->id

        ];
        Responsavel::create($grava);

        session()->flash('success', 'Usuário criado com sucesso!');
        return redirect(url('users'));




    }


    public function desabilitarUserUnico($id)
    {

        //dd($id);
        $user = User::find($id);



        if ($user) {
            $auth = auth()->user()->parceira;
            //dd($auth->parceira_id);
            $buscaResponsavels = $user->responsavels->where('parceira_id', $auth->parceira_id)->first();
            //dd($buscaResponsavels);

            if ($buscaResponsavels) {

                $buscaResponsavels->update(['status' => 0]);
                session()->flash('success', 'Usuário desabilitado com sucesso!');

                return redirect()->back();


            }
        }
    }

    public function ativarUserUnico($id)
    {
        $user = User::find($id);


        if ($user) {
            $auth = auth()->user()->parceira;
            //dd($auth->parceira_id);
            $buscaResponsavels = $user->responsavels->where('parceira_id', $auth->parceira_id)->first();
            //dd($buscaResponsavels);

            if ($buscaResponsavels) {

                $buscaResponsavels->update(['status' => 1]);
                session()->flash('success', 'Usuário Ativo com sucesso!');

                return redirect()->back();


            }
        }
    }

    public function saque()
    {
        $page = 'Tela de Solicitação de saque';

        $saques = Saque::where('parceira_id', auth()->user()->parceira->parceira->id)->get();

        return view('loja.saque', compact('page', 'saques'));
    }


    public function users()
    {
        $page = 'Gestão de Usuarios';
        $users = Responsavel::where('parceira_id', auth()->user()->parceira->parceira->id)->get();
        //dd($responsavel);
        //$users = User::whereIn('id',$responsavel)->get();
        //dd($usuarios);
        return view('loja.user', compact('page', 'users'));
    }


    public function buscaUser()
    {
        $page = 'Consulta Usuário';
        return view('loja.buscauser', compact('page'));
    }


    public function gerarsaque(Request $request)
    {
        // Validar o campo 'valor'
        $valorString = $request->input('valor'); // Supondo que 'valor' seja o nome do campo em seu formulário

        // Remove o "R$" e substitui "," por "."
        $valorSemSimbolo = str_replace('R$', '', $valorString);
        $valorSemVirgula = str_replace(',', '.', $valorSemSimbolo);

        // Converte a string resultante em um número float
        $request['valor'] = (float)$valorSemVirgula;
        $validator = Validator::make($request->all(), [
            'valor' => 'required|numeric',
        ]);

        // Verificar a condição de saldo insuficiente


        if ($validator->passes()) {
            $saldoDisponivel = auth()->user()->parceira->parceira->saldoTotal();

            if ($request->valor > $saldoDisponivel) {
                return redirect()->back()->withErrors(['saldo' => 'Saldo Insuficiente'])->withInput();
            }
        }

        // Se a validação passar, continue com o processamento
        $grava = [
            'parceira_id' => auth()->user()->parceira->parceira->id,
            'valor' => $request->valor,
            'user_id' => auth()->user()->id,
            'status' => 0
        ];

        $gravaExtrato = [
            'tipo' => 2,
            'valor' => $request->valor,
            'user_id' => auth()->user()->id,
            'descricao' => "Saque solicitado por " . auth()->user()->name,
            'parceira_id' => auth()->user()->parceira->parceira->id
        ];
        Extrato::create($gravaExtrato);
        Saque::create($grava);
        session()->flash('success', 'Saque solicitado com sucesso!');

        return redirect()->back();
    }

    public function consultaUser(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required'
        ]);

        $user = User::where('cpf', $request->cpf)->first();


        if ($user) {
            $auth = auth()->user()->parceira;
            //dd($auth->parceira_id);
            $buscaResponsavels = $user->responsavels->where('parceira_id', $auth->parceira_id)->first();

            if ($buscaResponsavels) {

                $page = 'Editar Usuário';
                return view('loja.editUser', compact('page', 'user', 'buscaResponsavels'));
            }
        } else {
            return redirect(url('newUser', $request->cpf));
        }
    }

    public function newUserForm($cpf)
    {

        $page = 'Novo Usuário';
        return view('loja.newUser', compact('page', 'cpf'));
    }

    public function editUserUnico($id)
    {
        $user = User::find($id);


        if ($user) {
            $auth = auth()->user()->parceira;
            //dd($auth->parceira_id);
            $buscaResponsavels = $user->responsavels->where('parceira_id', $auth->parceira_id)->first();
            //dd($buscaResponsavels);

            if ($buscaResponsavels) {

                $page = 'Editar Usuário';
                return view('loja.editUser', compact('page', 'user', 'buscaResponsavels'));
            }
        }
    }

    public function editUser(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required',
            'name' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
        ]);


        $user = User::find($request->user_id);

        $user->update($request->all());


        //dd($user);
        //dd($request->all());

        $reponsavel = Responsavel::find($request->resposavel_id);
        //dd($reponsavel);

        $reponsavel->update(['adminstrador' => $request->tipo_usuario]);

        session()->flash('success', 'Usuário atualizado com sucesso!');
        return redirect(url('users'));


    }

}
