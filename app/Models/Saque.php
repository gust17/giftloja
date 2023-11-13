<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saque extends Model
{
    use HasFactory;

    protected $fillable = [
        'parceira_id',
        'valor',
        'user_id',
        'status',
        'contrato_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function valorSaque()
    {
        return $this->valor - ($this->valor * ($this->contrato->plano->taxa/100));

    }

    public function dataLimite()
    {

        return $this->created_at->addDays($this->contrato->plano->dias)->format('d/m/Y');

    }
}
