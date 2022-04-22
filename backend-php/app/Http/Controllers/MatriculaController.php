<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Http\Resources\MatriculaResource;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'cedula_alumno' => 'required',
            'numero_grupo' => 'required',
        ]);

        $validacion = Matricula::all()
            ->where('cedula_alumno', $request->input('cedula_alumno'))
            ->where('numero_grupo', $request->input('numero_grupo'))
            ->first();

        if (isset($validacion)) {
            return response(
                [
                    'message' => 'Ya se ha matriculado este estudiante en ese grupo'
                ],
                422
            );
        }

        Matricula::create([
            'cedula_alumno' => $request->input('cedula_alumno'),
            'numero_grupo' => $request->input('numero_grupo'),
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function obtenerMatricula($cedula_alumno, $numero_grupo)
    {
        $matricula = Matricula::select()
            ->where('cedula_alumno', $cedula_alumno)
            ->where('numero_grupo', $numero_grupo)
            ->first();

        return new MatriculaResource($matricula);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'nota'=> 'required|numeric',

        ]);

        $matricula->update([
            'nota'=>$request->input('nota'),
        ]);
        
        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno::id  $cedula_alumno
     * @param  \App\Models\Grupo::id  $numero_grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($cedula_alumno, $numero_grupo)
    {
        $matricula = Matricula::where('cedula_alumno', $cedula_alumno)
            ->where('numero_grupo', $numero_grupo)
            ->first();

        $matricula->delete();

        return response(null, 204);
    }
}
