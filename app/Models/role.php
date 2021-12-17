<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = [
        'rol',
        'descripcion'
    ];

    public function participante()
    {
        return $this->belongsTo(Participantes::class);
    }
}
