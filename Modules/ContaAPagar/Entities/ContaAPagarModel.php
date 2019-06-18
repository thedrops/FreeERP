<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContaAPagarModel extends Model
{
    use SoftDeletes;

    public $table = 'conta_pagar';
    protected $fillable = ['id', 'descricao', 'valor', 'parcelas', 'categoria_pagar_id'];
    
    
     public function categoria(){ 
        return $this->hasOne('Modules\ContaAPagar\Entities\CategoriaModel', 'id', 'categoria_pagar_id')->withTrashed();
    }

}