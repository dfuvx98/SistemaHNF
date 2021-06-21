<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_Examen extends Model
{
    use HasFactory;
    protected $table='solicitud_examen';

    public function Tipo_examen(){
        return $this->BelongsTo(Tipo_examen::class);

    }
}
