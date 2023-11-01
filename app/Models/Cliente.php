<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';

    protected $table = 'users';


    public function tokens()
    {
        return $this->hasMany(TokenCliente::class, 'user_id', 'id');
    }

    public function extratos()
    {
        return $this->hasMany(ExtratoCliente::class, 'user_id', 'id');
    }


    public function entradas()
    {
        // dd($this->extratos);
        $busca = $this->extratos->where('tipo', 1)->sum('valor');

        return $busca;
    }

    public function saidas()
    {
        return $this->extratos->where('tipo', 2)->sum('valor');
    }

    public function saldoTotal()
    {
        //dd($this->extratos);
        return $this->entradas() - $this->saidas();
    }

}
