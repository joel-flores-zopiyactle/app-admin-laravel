<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\role;
use App\Models\Audiencia;
use App\Models\Asistencia;

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

    public function audiencia()
    {
        return $this->hasOne(Audiencia::class, 'id', 'audiencia_id');
    }

    public function asitencia()
    {
        return $this->hasOne(Asistencia::class, 'participante_id', 'id');
    }


}
