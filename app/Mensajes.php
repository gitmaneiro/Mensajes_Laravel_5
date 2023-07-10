<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mensajes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mensaje', 'status'
    ];
}
