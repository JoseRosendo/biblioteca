<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table='autores';

    protected $primaryKey='id_autor';//llave primaria
    
    public $incrementing=true;// la clave primaria es numerica

    public $timestamps=false;  //se va a utilizar etiquetas de tiempo
    
    //lista de campos que van a consumir valor
    protected $fillable=[
    	
        'id_autor',
        'nombre',
        'apellido_p',
        'apellido_m',
        'pais',
        'anio_nacimiento',
        'anio_defuncion',
        
    ];

}
