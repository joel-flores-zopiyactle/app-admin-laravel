<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = [
        'sala',
        'numero',
        'ubicacion',
        'capacidad'
    ];

    public function expediente()
    {
        return $this->belongsTo(Audiencia::class);
    }
}
