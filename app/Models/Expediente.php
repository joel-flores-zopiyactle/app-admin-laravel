<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audiencia;

class Expediente extends Model
{
    use HasFactory;

    public function audiencia()
    {
        return $this->hasOne(Audiencia::class);
    }
}
