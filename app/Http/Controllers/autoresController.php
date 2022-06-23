<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
//use App\Http\Requests\autores\UpdateRequest


class autoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $autores=Autor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autores=new Autor();

        $autores->id_autor=$request->get('id_autor');
        $autores->nombre=$request->get('nombre');
        $autores->apellido_p=$request->get('apellido_p');
        $autores->apellido_m=$request->get('apellido_m');
        $autores->pais=$request->get('pais');
        $autores->anio_nacimiento=$request->get('anio_nacimiento');
        $autores->anio_defuncion=$request->get('anio_defuncion');

        $autores->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $autores=Autor::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //reconoce,busca en la base de datos la tabla con esa id
        $autor=Autor::find($id);
        //llamar los datos que contiene la tabla
        $autor->nombre=$request->nombre;
        $autor->apellido_p=$request->apellido_p;
        $autor->apellido_m=$request->apellido_m;
        $autor->pais=$request->pais;
        $autor->anio_nacimiento=$request->anio_nacimiento;
        $autor->anio_defuncion=$request->anio_defuncion;
        $autor->estado=1;
        $autor->update(); //actualiza los datos que se obtiene del request

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function softdelete(Request $request)
    {
        //
        $autor=Autor::find($request->id_autor);
        $autor->estado=0;
        $autor->update();
    }
}
