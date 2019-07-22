<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TDestino extends Model
{
    protected $table = "tdestinos";

    public function paquetes_destinos()
    {
        return $this->hasMany(TPaqueteDestino::class, 'iddestinos');
    }

    public function destino_imagen()
    {
        return $this->hasMany(TDestinoImagen::class, 'iddestinos');
    }
}
