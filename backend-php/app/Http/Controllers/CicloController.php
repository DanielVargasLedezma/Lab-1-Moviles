<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CicloResource;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CicloResource::collection(
            Ciclo::all()
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
            'numero_ciclo' => 'required|numeric',
            'year' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'ciclo_activo' => 'required|numeric',
        ]);

        if ($request->input('ciclo_activo') === "1") {
            DB::statement('Update GestionAcademica.Ciclos set CICLO_ACTIVO=0');
            DB::statement('commit');
        }

        Ciclo::create([
            'numero_ciclo' => $request->input('numero_ciclo'),
            'year' => $request->input('year'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_finalizacion' => $request->input('fecha_finalizacion'),
            'ciclo_activo' => $request->input('ciclo_activo'),
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function show(Ciclo $ciclo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciclo $ciclo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciclo $ciclo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciclo $ciclo)
    {
        //
    }
}
