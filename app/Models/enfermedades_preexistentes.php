<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfermedades_preexistentes extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $table= 'enfermedades_preexistentes';
    protected $fillable = [
        'idPersona',
        'nombre',
        'observacion',
        'diagnostico',
        'fecha_diagnostico',
        'fecha_registro',
    ];

    public function Paciente(){
        return $this->belongsTo(Persona::class,'idPersona');
    }

}
