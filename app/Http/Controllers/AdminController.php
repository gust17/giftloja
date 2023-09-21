<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function movimento()
    {
        $page = 'Movimentações';

        return view('loja.movimentacao',compact('page'));
    }
}
