<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $primaryKey = 'numero_grupo';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_grupo',
        'codigo_curso',
        'cedula_profesor',
        'id_ciclo',
        'horario',
        'dia_uno',
        'dia_dos',
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

    public function curso()
    {
        return $this->hasOne(Curso::class, 'codigo_curso', 'codigo_curso');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'cedula_profesor', 'cedula_profesor');
    }

    public function ciclo()
    {
        return $this->hasOne(Ciclo::class, 'id_ciclo', 'id_ciclo');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'numero_grupo', 'numero_grupo');
    }

    public function alumnosMatriculados()
    {
        return $this->hasManyThrough(Alumno::class, Matricula::class, 'numero_grupo', 'cedula_alumno', 'numero_grupo', 'cedula_alumno');
    }
}
