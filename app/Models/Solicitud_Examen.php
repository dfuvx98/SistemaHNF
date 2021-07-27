<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_Examen extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $table='solicitud_examen';

    protected $fillable = [
        'idConsulta',
        'detalle',
        'idTipo'
    ];

    public function Tipo_examen(){
        return $this->BelongsTo(Tipo_examen::class);

    }
}
