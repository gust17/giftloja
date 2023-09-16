<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    use HasFactory;


    public function parceira()
    {
        return $this->belongsTo(Parceira::class);
    }

    public function getTipoFormatedAttribute()
    {
        if ($this->attributes['adminstrador']==1){
            return 'Administrador';
        }
        return 'Comum';
    }
}
