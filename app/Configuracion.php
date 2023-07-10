<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configuracion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidadMensajes', 'velocidad'
    ];
}
