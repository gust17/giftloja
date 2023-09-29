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

    public function saque()
    {
        $page = 'Tela de Solicitação de saque';

        $saques = Saque::where('parceira_id',auth()->user()->parceira->parceira->id)->get();

        return view('loja.saque', compact('page','saques'));
    }


    public function users()
    {
        $page = 'Gestão de Usuarios';
        $users = Responsavel::where('parceira_id',auth()->user()->parceira->parceira->id)->get();
        //dd($responsavel);
        //$users = User::whereIn('id',$responsavel)->get();
        //dd($usuarios);
        return view('loja.user', compact('page','users'));
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

}
