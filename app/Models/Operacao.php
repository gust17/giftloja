<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'parceira_id',
        'cliente_id',
        'code',
        'valor',
        'status',
        'extrato_id'

    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

}
