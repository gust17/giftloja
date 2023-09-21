<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtratoCliente extends Model
{
    use HasFactory;


    protected $connection = 'mysql2';


    protected $table = 'extratos';

    protected $fillable = ['tipo',
        'valor',
        'user_id',
        'descricao'
    ];
}
