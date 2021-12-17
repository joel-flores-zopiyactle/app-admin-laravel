<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\role;

class Participantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'rol_id',
        'audiencia_id'  
    ];

    public function rol()
    {
        return $this->hasOne(role::class, 'id', 'rol_id');
    }
}
