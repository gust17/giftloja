<?php

namespace App\Http\Controllers;

use App\Models\Parceira;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class ParceiraController extends Controller
{

    public function index()
    {
        $parceiras = Parceira::all(); // Recupere todas as parceiras disponíveis

        return view('selecionar_parceira', compact('parceiras'));
    }

    public function selecionar(Request $request)
    {
        $parceiraIdSelecionada = $request->input('parceira_id');

        // Atualize a parceira selecionada para o usuário autenticado
        $user = Auth::user();
        $user->update(['parceira_selecionada' => $parceiraIdSelecionada]);

        return redirect()->route('dashboard.index'); // Redirecione para a página inicial
    }

    public function dashboard($id)
    {

        //dd($id);
        $parceira = Responsavel::findOrFail($id);

        // Verifique se o usuário tem permissão para acessar esta parceira usando a política
        $this->authorize('view', $parceira);
        $user = auth()->user();
        $user->update(['parceira_selecionada' => $id]);

        // Coloque aqui o código para exibir o painel da parceira selecionada
        return view('dashboard.parceira', compact('parceira'));
    }
}
