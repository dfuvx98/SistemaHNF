<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table ='personas';
    use HasFactory;

    public function Tipo_Persona(){
        return $this->belongsTo(Tipo_Persona::class);
    }

    public function Citas(){
        return $this->hasMany(Cita::class);
    }

    public function Usuario(){
        return $this->hasOne(Usuario::class);
    }

    public function Persona_especialidad(){
        return $this->hasMany(Persona_especialidad::class);
    }

    public function Cliente(){
        return $this->belongsTo(Persona::class,'idPersona');
    }

    public function Pacientes(){
        return $this->hasMany(Persona::class,'idPersona');
    }
    
}
