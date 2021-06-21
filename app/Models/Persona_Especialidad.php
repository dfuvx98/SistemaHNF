<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_Especialidad extends Model
{
    protected $table='persona_especialidad';
    use HasFactory;

    public function especialidad(){
        retrun $this-> belongsTo(Especialidades::class); 
    }
}
