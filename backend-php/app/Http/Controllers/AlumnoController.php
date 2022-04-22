<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Mail\TemporaryPassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\GrupoResource;
use App\Http\Resources\AlumnoResource;
use App\Http\Resources\MatriculaResource;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AlumnoResource::collection(
            Alumno::all()
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function matriculasAlumno(Alumno $alumno)
    {
        return MatriculaResource::collection(
            $alumno->matriculas
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
            'cedula_alumno' => 'required|string|unique:alumnos',
            'nombre' => 'required|string',
            'telefono' => 'required|numeric',
            'correoe' => 'required|email',
            'fecha_nacimiento' => 'required', 'date',
            'codigo_carrera' => 'required|string',
        ]);

        $password = GenerateTempPassword::generatePasswordTemp($request);

        Alumno::create([
            'cedula_alumno' => $request->input('cedula_alumno'),
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'correoE' => $request->input('correoe'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'codigo_carrera' => $request->input('codigo_carrera'),
            'clave' => Hash::make($password),
        ]);

        TemporaryPassword::sendMail($request->input('cedula_alumno'), $request->input('nombre'), $request->input('correoe'), $password);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Retorna los grupos matriculados por un estudiante.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function gruposMatriculados(Alumno $alumno)
    {
        return GrupoResource::collection($alumno->gruposMatriculados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre' => 'required|string',
            'telefono' => 'required|numeric',
            'correoe' => 'required|email',
            'fecha_nacimiento' => 'required', 'date',
            'codigo_carrera' => 'required|string',
        ]);

        $alumno->update([
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'correoE' => $request->input('correoe'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'codigo_carrera' => $request->input('codigo_carrera'),
        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $matriculas = $alumno->matriculas;

        if (isset($matriculas)) {
            return response([
                'message' => 'El estudiante posee grupos matriculados y por esto no puede ser eliminado.'
            ], 422);
        }

        $alumno->delete();

        return response(null, 204);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'cedula_alumno' => 'required|string',
            'clave' => 'required|string'
        ]);

        # Buscar y obtener el profesor de la base de datos
        $alumno = Alumno::where('cedula_alumno', $fields['cedula_alumno'])->first();

        # Validar si el pro$alumno no existe o si la clave es incorrecta
        if (!isset($alumno) || !Hash::check($fields['clave'], $alumno->clave)) {
            return response([
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        $token = $alumno->createToken('myapptoken')->plainTextToken;

        return response([
            'alumno' => new AlumnoResource($alumno),
            'token' => $token
        ], 201);
    }
}
