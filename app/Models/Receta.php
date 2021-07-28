<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = [
        'medicamentos',
        'tratamiento',
        'idConsulta'
    ];
    protected $table ='receta';

    public function Consulta(){
        return $this->belongsTo(Consulta::class,'idConsulta');
    }
}
