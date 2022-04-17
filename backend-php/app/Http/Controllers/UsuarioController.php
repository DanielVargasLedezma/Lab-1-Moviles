<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsuarioResource;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return UsuarioResource::collection(
            Usuario::all()
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
            'cedula' => 'required|string|unique:usuarios,cedula_usuario',
            'nombre' => 'required|string',
            'tipo_usuario' => 'required|numeric',
            'estado' => 'required|numeric'
        ]);
        Usuario::create([
            'cedula_usuario' => $request->input('cedula'),
            'nombre' => $request->input('nombre'),
            'tipo_usuario' => $request->input('tipo_usuario'),
            'estado' => $request->input('estado'),
            'clave' => '123',
        ]);

        return response(null, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
        $request->validate([
            'nombre' => 'required|string',
            'tipo_usuario' => 'required|numeric',
            'estado' => 'required|numeric'
        ]);
        $usuario->update([
            'nombre' => $request->input('nombre'),
            'tipo_usuario' => $request->input('tipo_usuario'),
            'estado' => $request->input('estado')
        ]);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'cedula_usuario' => 'required|string',
            'clave' => 'required|string'
        ]);

        # Buscar y obtener el usuario de la base de datos
        $usuario = Usuario::where('CEDULA_USUARIO', $fields['cedula_usuario'])->first();

        # Validar si el usuario no existe o si la clave es incorrecta
        if (!isset($usuario) || !Hash::check($fields['clave'], $usuario->clave)) {
            return response([
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        $token = $usuario->createToken('myapptoken')->plainTextToken;

        return response([
            'usuario' => new UsuarioResource($usuario),
            'token' => $token
        ], 201);
    }
}
