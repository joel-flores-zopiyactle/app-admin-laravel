<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAudiencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'rol_personal_id',
        'audiencia_id'  
    ];

    public function rolPersonal()
    {
        return $this->hasOne(RolesPersonal::class, 'id', 'rol_personal_id');
    }

    public function audiencia()
    {
        return $this->hasOne(Audiencia::class, 'id', 'audiencia_id');
    }

    public function asitencia()
    {
        return $this->hasOne(AsistenciaPersonalAudiencia::class, 'personal_id', 'id');
    }
}
