<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table ='citas';
    //Protected para campos que no se pueden ingresar masivamente
    protected $guarded = [ 'id'];

    public function Consulta(){
        
        return $this->hasOne(Consulta::class,'idCita');
    }

}
