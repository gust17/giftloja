<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'tipo',
            'valor',
            'user_id',
            'descricao',
            'parceira_id'

        ];

    protected $connection = 'mysql';
    protected $table='extratos';


    public function parceira()
    {
        return $this->belongsTo(Parceira::class,'parceira_id','id');
    }


    public function getStatusFormatedAttribute()
    {
        if ($this->attributes['tipo'] == 2) {
            return 'Saida';
        }
        return 'Entrada';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operacao()
    {
        return $this->hasOne(Operacao::class);
    }
}
