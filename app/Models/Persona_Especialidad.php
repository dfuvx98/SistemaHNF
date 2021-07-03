<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_Especialidad extends Model
{
    protected $table='persona_especialidad';
    use HasFactory;

    public function persona(){
        //return $this->belongsTo(Persona::class,'personas','id','idPersona'); 
        return $this->belongsToMany(Persona::class,'personas','id');
    }

    public function especialidad(){
        return $this-> belongsTo(Especialidades::class); 
    }
}
