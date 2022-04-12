<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        //
    }
}
