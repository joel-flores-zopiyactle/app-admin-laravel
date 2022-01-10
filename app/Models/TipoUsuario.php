<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    public function permiso()
    {
        return $this->hasOne(Permisos::class,'tipo_user_id');
    }
}
