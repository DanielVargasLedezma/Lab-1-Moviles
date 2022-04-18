<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Resources\CursoResource;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CursoResource::collection(
            Curso::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'codigo_curso' => 'required|string|unique:cursos',
            'codigo_carrera'=> 'required|string', 
            'nombre'=> 'required|string',
            'creditos' => 'required|numeric',
            'horas_semanales' => 'required|numeric',
            'num_semestre_a_llevar' => 'required|numeric',
            'anyo_a_llevar'=> 'required|string',
            ]);

        Curso::create([
            'codigo_curso' => $request->input('codigo_curso'),
            'codigo_carrera'=> $request->input('codigo_carrera'), //confirmar con Dani
            'nombre'=> $request->input('nombre'),
            'creditos' => $request->input('creditos'),
            'horas_semanales' => $request->input('horas_semanales'),
            'num_semestre_a_llevar' => $request->input('num_semestre_a_llevar'),
            'anyo_a_llevar'=> $request->input('anyo_a_llevar'),
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        //
        $request->validate([
            
            'codigo_carrera'=> 'required|string', 
            'nombre'=> 'required|string',
            'creditos' => 'required|numeric',
            'horas_semanales' => 'required|numeric',
            'num_semestre_a_llevar' => 'required|numeric',
            'anyo_a_llevar'=> 'required|string',
            ]);

        $curso->update([
            
            'codigo_carrera'=> $request->input('codigo_carrera'), 
            'nombre'=> $request->input('nombre'),
            'creditos' => $request->input('creditos'),
            'horas_semanales' => $request->input('horas_semanales'),
            'num_semestre_a_llevar' => $request->input('num_semestre_a_llevar'),
            'anyo_a_llevar'=> $request->input('anyo_a_llevar'),
        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //
    }
}
