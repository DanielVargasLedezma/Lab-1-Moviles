<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Mail\TemporaryPassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfesorResource;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProfesorResource::collection(
            Profesor::all()
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
            'cedula_profesor' => 'required|string|unique:profesores',
            'nombre' => 'required|string',
            'telefono' => 'required|numeric',
            'correo' => 'required|email',
        ]);

        $password = GenerateTempPassword::generatePasswordTemp($request);

        Profesor::create([
            'cedula_profesor' => $request->input('cedula_profesor'),
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'correoE' => $request->input('correo'),
            'clave' => Hash::make($password),
        ]);

        TemporaryPassword::sendMail($request->input('cedula_profesor'), $request->input('nombre'), $request->input('correo'), $password);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor $profesor)
    {
        //
        $request->validate([

            'nombre' => 'required|string',
            'telefono' => 'required|numeric',
            'correo' => 'required|email',

        ]);

        $profesor->update([

            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'correoE' => $request->input('correo'),

        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor)
    {
        $grupos = $profesor->grupos()
            ->first();

        if (isset($grupos)) {
            return response([
                'message' => 'El profesor está asociado a algun grupo y no puede ser eliminado por esto.'
            ], 422);
        }

        $profesor->delete();

        return response(null, 204);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'cedula_profesor' => 'required|string',
            'clave' => 'required|string'
        ]);

        # Buscar y obtener el profesor de la base de datos
        $profesor = Profesor::where('cedula_profesor', $fields['cedula_profesor'])->first();

        # Validar si el pro$profesor no existe o si la clave es incorrecta
        if (!isset($profesor) || !Hash::check($fields['clave'], $profesor->clave)) {
            return response([
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        $token = $profesor->createToken('myapptoken')->plainTextToken;

        return response([
            'profesor' => new ProfesorResource($profesor),
            'token' => $token
        ], 201);
    }
}
