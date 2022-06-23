<?php

namespace App\Http\Requests\autores;

use Iluminate\Foundation\Http\FormRequest;
class StoreRequest extends FormRequest
{
    //Autorizacion para que pueda accer el metodo POST
    public function authorize()
    {
        return true;
    }
    //Reglas para que pueda agregar un registro
    public function rules()
    {
        return [
            //
            'nombre'=>'required|string|max:255',
            'apellido_p'=>'nullable|string|max:255',
            'apellido_m'=>'nullable|string|max:255',
            'pais'=>'nullable|string|max:255',
            'anio_nacimiento'=>'required|date|max:255',
            'anio_defuncion'=>'nullable|date|max:255',

        ];
    }
    //Mensajes en caso de que exista un error.
    public function messages()
    {
        return [
            //Mensaje de error para el nombre.
            'nombre.required'=>'El campo nombre es requerido',
            'nombre.string'=>'Este campo debe ser un string',
            'nombre.max'=>'El valor máximo ha sido superdo',

            //Mensaje de error para el apellido paterno
            'apellido_p.string'=>'Este campo debe ser un string',
            'apellido_p.max'=>'El valor máximo ha sido superado',

            //Mensaje de error para el apellido materno
            'apellido_m.string'=>'Este campo debe ser un string',
            'apellido_m.max'=>'El valor máximo ha sido superado',

            //Mensaje de error para el pais
            'pais.string'=>'Este campo debe ser un string',
            'pais.max'=>'El valor máximo ha sido superado',

            //Mensaje de error para el año de nacimiento.
            'nombre.required'=>'Este campo es requerido',
            'nombre.date'=>'Este campo debe ser una fecha',
            'nombre.max'=>'El valor máximo ha sido superdo',

            //Mensaje de error para el año de defuncion
            'nombre.date'=>'Este campo debe ser una fecha',
            'nombre.max'=>'El valor máximo ha sido superdo',
        ];
    }
}