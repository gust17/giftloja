<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Extrato;
use App\Models\ExtratoCliente;
use App\Models\Operacao;
use Illuminate\Http\Request;

class FrenteCaixaController extends Controller
{
    public function index()
    {
        $page = 'Frente de Caixa';
        return view('loja.venda', compact('page'));
    }

    public function finaliza(Request $request)
    {
        //dd($request->all());


        $cliente = Cliente::where('cpf', $request->cpf)
            ->whereHas('tokens', function ($query) use ($request) {
                $query->where('token', $request->token)
                    ->where('status', 0);
            })
            ->first();

        if (!$cliente) {

            return redirect()->back()->with('error','Token ou cliente invalido');

        }
        //dd($cliente->saldoTotal());


        //dd($cliente->extratos);
        if ($request['valor'] <= $cliente->saldoTotal()) {

            $gravaExtratoCliente = ['tipo' => 2, 'valor' => floatval($request->valor), 'user_id' => $cliente->id, 'descricao' => 'Saldo utilizado na loja Parceira ' . auth()->user()->parceira->parceira->name];
            $gravaExtratoLoja = ['tipo' => 1, 'valor' => floatval($request->valor), 'user_id' => auth()->user()->id, 'descricao' => 'Pagamento Realizado pelo cliente ' . $cliente->name, 'parceira_id' => auth()->user()->parceira->parceira->id];

            $extratoLoja = Extrato::create($gravaExtratoLoja);
            $operacao = Operacao::create(
                ['parceira_id'=> auth()->user()->parceira->parceira->id,
                'cliente_id'=>$cliente->id,
                'code'=> $request->token,
                'valor'=> $request->valor,
                'status'=> 1,
                'extrato_id'=> $extratoLoja->id
            ]);

            $token = $cliente->tokens->where('token', $request->token)->first();
            $token->update(['status' => 1]);

            //dd($gravaExtratoCliente);


            $extratoCliente = ExtratoCliente::create($gravaExtratoCliente);

            return redirect()->route('recibo',['id'=>$extratoLoja->id])->with('success','Venda Realizada com sucesso');

        } else {
            $gravaExtratoCliente = ['tipo' => 2, 'valor' => $cliente->saldoTotal(), 'user_id' => $cliente->id];

            return redirect()->back()->with('error','Saldo insuficiente');
        }
    }
}
