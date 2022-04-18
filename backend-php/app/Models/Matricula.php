<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $primaryKey = 'numero_matricula';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cedula_alumno',
        'numero_grupo',
        'nota',
    ];

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = null;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    public function grupo()
    {
        return $this->hasOne(Grupo::class, 'numero_grupo', 'numero_grupo');
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'cedula_alumno', 'cedula_alumno');
    }
}
