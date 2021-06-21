<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_examen extends Model
{
    protected $table = 'tipos_examen';
    use HasFactory;
    protected $guarded = [ 'id'];
    
    public function Solicitud_Examen(){
        return $this->hasMany(Solicitud_Examen::class,'idTipo');
    }

}
