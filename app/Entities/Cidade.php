<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model{

    protected $table = 'cidade';

    protected $fillable = ['nome', 'estado_id'];

    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('app\Entities\Estado','estado_id');
    }
    
}   