<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Extrato;
use App\Models\ExtratoCliente;
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


            return redirect()->back();
        }
        //dd($cliente->saldoTotal());


        if ($request['valor'] <= $cliente->saldoTotal()) {

            $gravaExtratoCliente = ['tipo' => 2, 'valor' => floatval($request->valor), 'user_id' => $cliente->id, 'descricao' => 'Saldo utilizano na loja Parceira ' . auth()->user()->parceira->parceira->name];
            $gravaExtratoLoja = ['tipo' => 1, 'valor' => floatval($request->valor), 'user_id' => auth()->user()->id, 'descricao' => 'Pagamento Realizado pelo cliente ' . $cliente->name,'parceira_id'=>auth()->user()->parceira->id];

            $extratoLoja = Extrato::create($gravaExtratoLoja);

            $token = $cliente->tokens->where('token', $request->token)->first();
            $token->update(['status'=>1]);

            //dd($gravaExtratoCliente);


            $extratoCliente = ExtratoCliente::create($gravaExtratoCliente);

            return redirect()->route('caixa');

        } else {
            $gravaExtratoCliente = ['tipo' => 2, 'valor' => $cliente->saldoTotal(), 'user_id' => $cliente->id];

            dd($gravaExtratoCliente);
        }
    }
}
