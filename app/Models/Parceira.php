<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parceira extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';


    protected $table = 'parceiras';


    protected $primaryKey = 'id';


    public function extratos()
    {
        return $this->hasMany(Extrato::class);
    }

    public function entrada()
    {
        return $this->extratos()->where('tipo',1)->sum('valor');
    }

    public function saidas()
    {
        return $this->extratos()->where('tipo',2)->sum('valor');
    }

    public function saldoTotal()
    {
        //dd($this->entrada());
        return $this->entrada()-$this->saidas();
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }



}
