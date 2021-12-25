<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audiencia;
use App\Models\TipoJuicio;

class Expediente extends Model
{
    use HasFactory;

    public function audiencia()
    {
        return $this->hasOne(Audiencia::class);
    }

    public function tipoJuicio()
    {
        return $this->hasOne(TipoJuicio::class, 'id', 'juicio_id');
    }

    public function token()
    {
        return $this->hasOne(TokenAudiencia::class);
    }

    public function tokenInvitado()
    {
        return $this->hasOne(TokenAudienciaInvitado::class);
    }




}
