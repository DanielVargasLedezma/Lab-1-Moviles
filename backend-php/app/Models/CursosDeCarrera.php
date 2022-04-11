<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CursosDeCarrera extends Model
{
    use HasFactory;

    protected $table = 'cursos_de_carreras';

    protected $primaryKey = ['codigo_carrera', 'codigo_curso', 'id_ciclo'];

    protected $keyType = ['string', 'string', 'int'];

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_carrera',
        'codigo_curso',
        'id_ciclo',
        'year',
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

    // /**
    //  * Set the keys for a save update query.
    //  *
    //  * @param  \Illuminate\Database\Eloquent\Builder  $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // protected function setKeysForSaveQuery($query)
    // {
    //     $keys = $this->getKeyName();
    //     if (!is_array($keys)) {
    //         return parent::setKeysForSaveQuery($query);
    //     }

    //     foreach ($keys as $keyName) {
    //         $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
    //     }

    //     return $query;
    // }

    // /**
    //  * Get the primary key value for a save query.
    //  *
    //  * @param mixed $keyName
    //  * @return mixed
    //  */
    // protected function getKeyForSaveQuery($keyName = null)
    // {
    //     if (is_null($keyName)) {
    //         $keyName = $this->getKeyName();
    //     }

    //     if (isset($this->original[$keyName])) {
    //         return $this->original[$keyName];
    //     }

    //     return $this->getAttribute($keyName);
    // }
}
