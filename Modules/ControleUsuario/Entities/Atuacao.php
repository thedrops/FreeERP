<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atuacao extends Model
{
    use SoftDeletes;
    protected $table='atuacao';
    protected $timestamps=false;

    public function usuario()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Usuario');
    }

    public function papel()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Papel');
    }

    public function modulo()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Modulo');
    }
}