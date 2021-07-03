<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    public $timestamps =false;
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'email',
        'telefono',
        'direccion',
        'ciudadResi',
        'fechaNacimiento',
        'genero',
        'estado',
        'idTipoPersona'
    ];
    protected $table ='personas';
    use HasFactory;

    public function Tipo_Persona(){
        return $this->belongsTo(Tipo_Persona::class);
    }

    public function Citas(){
        return $this->hasMany(Cita::class);
    }

    public function Users(){
        return $this->hasOne(User::class,'idPersona');
    }
    
    public function Persona_especialidad(){
        return $this->belongsToMany(Especialidades::class,'persona_especialidad','idPersona','idEspecialidad');
    }

    public function Cliente(){
        return $this->hasMany(Persona::class,'idPersona');
    }

    public function Pacientes(){
        return $this->belongsTo(Persona::class,'idPersona');
    }
    
}
