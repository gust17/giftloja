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
}
