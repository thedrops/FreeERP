<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model{

    protected $table = 'estado';

    protected $fillable = ['nome'];

    public $timestamps = false;
    
}   