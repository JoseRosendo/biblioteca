<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
// use App\Http\Request\autores\StoreRequest;
// use App\Http\Request\autores\UpdateRequest;
//use App\Http\Requests\autores\UpdateRequest


class AutoresController extends Controller
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
    // public function store(StoreRequest $request)
    // {
        
       
        // Autor::create($request->all());
        // return redirect()->route('agregar');

    // }
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
            $autores->estado=1;
    
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
    // public function update(UpdateRequest $request, Autor $autores)
    // {
    //     $autores->update($request->all());
    //     return redirect()->route('agregar');
    // }

    public function update(Request $request, $id)
    {
        //reconoce,busca en la base de datos la tabla con esa id
        $autores=Autor::find($id);
        //llamar los datos que contiene la tabla
        $autores->nombre=$request->nombre;
        $autores->apellido_p=$request->apellido_p;
        $autores->apellido_m=$request->apellido_m;
        $autores->pais=$request->pais;
        $autores->anio_nacimiento=$request->anio_nacimiento;
        $autores->anio_defuncion=$request->anio_defuncion;
        $autores->estado=1;
        $autores->update(); //actualiza los datos que se obtiene del request

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
        $autores=Autor::find($request->id_autor);
        $autores->estado=0;
        $autores->update();
    }
}
