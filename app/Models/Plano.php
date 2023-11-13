<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;


    protected $connection = 'mysql2';

    protected $table = 'planos';

    protected $primaryKey = 'id';


    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }
}
