<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    public $timestamps =false;
    protected $fillable = [
        'nombre',
    ];
    protected $table ='especialidades';
    use HasFactory;
}
