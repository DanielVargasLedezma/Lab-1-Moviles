<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $primaryKey = 'codigo_curso';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_curso',
        'codigo_carrera',
        'nombre',
        'creditos',
        'horas_semanales',
        'num_semestre_a_llevar',
        'anyo_a_llevar',
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

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'codigo_carrera', 'codigo_carrera');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'codigo_curso', 'codigo_curso');
    }
}
