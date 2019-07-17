<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitante extends Model
{
    Use SoftDeletes;
    protected $table = 'solicitante';
    public $timestamps = true;
    protected $fillable = array('id','nome');
}
