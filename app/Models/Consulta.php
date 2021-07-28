<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $table= 'consulta';

    protected $fillable = [
        'idCita',
        'sintomas',
        'tratamiento',
        'diagnostico',
        'fecha_proximo_control',
        'fecha',
        'hora'
    ];

    public function Solicitud_Examen(){
        return $this->hasMany(Solicitud_Examen::class,'idConsulta');
    }

    public function Receta(){
        return $this->hasOne(Receta::class,'idConsulta');
    }

    public function Cita(){
        return $this->belongsTo(Cita::class,'idCita');
    }
}
