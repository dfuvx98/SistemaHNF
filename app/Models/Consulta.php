<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table= 'consulta';

    public function Solicitud_Examen(){
        return $this->hasMany(Solicitud_Examen::class);
    }

}
