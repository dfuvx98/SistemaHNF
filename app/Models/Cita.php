<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $table ='citas';
    protected $fillable = [
        'idPersonaD',
        'idPersonaP',
        'fecha',
        'hora',
        'idEspecialidad'
    ];
    //Protected para campos que no se pueden ingresar masivamente
    protected $guarded = [ 'id'];

    public function Consulta(){
        return $this->hasOne(Consulta::class,'idCita');
    }

    public function Paciente(){
        return $this->belongsTo(Persona::class,'idPersonaP');
    }

    public function Medico(){
        return $this->belongsTo(Persona::class,'idPersonaD');
    }

    public function Especialidades(){
        return $this->belongsTo(Especialidades::class,'idEspecialidad');
    }
}
