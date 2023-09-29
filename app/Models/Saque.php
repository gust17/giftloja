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
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
