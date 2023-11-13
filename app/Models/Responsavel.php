<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    use HasFactory;

    protected $fillable = [
        'adminstrador',
        'status',
        "parceira_id",
        "user_id",

    ];


    public function parceira()
    {
        return $this->belongsTo(Parceira::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTipoFormatedAttribute()
    {
        if ($this->attributes['adminstrador'] == 1) {
            return 'Administrador';
        }
        return 'Comum';
    }
}
