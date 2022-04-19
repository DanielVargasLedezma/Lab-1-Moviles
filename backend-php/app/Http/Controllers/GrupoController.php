<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use App\Http\Resources\GrupoResource;

class GrupoController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gruposProfesor($cedula_profesor)
    {
        return GrupoResource::collection(
            Grupo::where('cedula_profesor', $cedula_profesor)
                ->get()
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gruposCurso($codigo_curso)
    {
        return GrupoResource::collection(
            Grupo::where('codigo_curso', $codigo_curso)
                ->get()
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
        $request->validate([
            'numero_grupo' => 'required|string|unique:GRUPOS',
            'codigo_curso' => 'required|string',
            'cedula_profesor' => 'required|string',
            'id_ciclo' => 'required|numeric',
            'horario' => 'required|string',
            'dia_uno' => 'required|string',
            'dia_dos' => 'nullable|string',
        ]);

        Grupo::create([
            'numero_grupo' => $request->input('numero_grupo'),
            'codigo_curso' => $request->input('codigo_curso'),
            'cedula_profesor' => $request->input('cedula_profesor'),
            'id_ciclo' => $request->input('id_ciclo'),
            'horario' => $request->input('horario'),
            'dia_uno' => $request->input('dia_uno'),
            'dia_dos' => $request->input('dia_dos'),
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'codigo_curso' => 'required|string',
            'cedula_profesor' => 'required|string',
            'id_ciclo' => 'required|numeric',
            'horario' => 'required|string',
            'dia_uno' => 'required|string',
            'dia_dos' => 'nullable|string',
        ]);

        $grupo->update([
            'codigo_curso' => $request->input('codigo_curso'),
            'cedula_profesor' => $request->input('cedula_profesor'),
            'id_ciclo' => $request->input('id_ciclo'),
            'horario' => $request->input('horario'),
            'dia_uno' => $request->input('dia_uno'),
            'dia_dos' => $request->input('dia_dos'),
        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
