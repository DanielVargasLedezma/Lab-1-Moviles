<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\GrupoResource;
use App\Http\Resources\CarreraResource;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarreraResource::collection(
            Carrera::all()
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
            'codigo_carrera' => 'required|string|unique:carreras',
            'nombre' => 'required|string',
            'titulo' => 'required|string'
        ]);


        // DB::select('call insertarCarrera(?, ?, ?)', array($request->input('codigo_carrera'), $request->input('nombre'), $request->input('titulo')));

        Carrera::create([
            'codigo_carrera' => $request->input('codigo_carrera'),
            'nombre' => $request->input('nombre'),
            'titulo' => $request->input('titulo')
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function gruposCarrera(Carrera $carrera)
    {
        return GrupoResource::collection($carrera->grupos);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            'nombre' => [
                'required', 'string'
            ],
            'titulo' => [
                'required', 'string'
            ],
        ]);

        $carrera->update([
            'nombre' => $request->input('nombre'),
            'titulo' => $request->input('titulo'),
        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrera $carrera)
    {
        $cursos = $carrera->cursos()->first();

        if (isset($cursos)) {
            return response([
                'message' => 'La carrera posee cursos relacionados y por esto no puede ser eliminada.'
            ], 422);
        }

        $alumnos = $carrera->alumnos()->first();

        if (isset($alumnos)) {
            return response([
                'message' => 'La carrera posee alumnos relacionados y por esto no puede ser eliminada.'
            ], 422);
        }

        $carrera->delete();

        return response(null, 204);
    }
}
