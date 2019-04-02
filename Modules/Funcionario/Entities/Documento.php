<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model{

    protected $table = 'documento';

    protected $fillable = ['tipo', 'numero', 'comprovante'];

    public $timestamps = false;
}   