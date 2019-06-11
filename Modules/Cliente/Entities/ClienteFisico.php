<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Documento;

class ClienteFisico extends Model
{
    protected $table = 'cliente';
    //protected $primaryKey = 'id';

    protected $fillable = ['nome','data_nascimento', 'sexo', 'tipo_cliente_id'];
    public $timestamps = false;

    public function documentoRelacao(){
        return $this->hasMany('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','cliente')
            ->where('tabela_destino','documento');
    }

    public function documentos(){
        $dados = [];
        foreach($this->documentoRelacao as $relacao){
            $dados[] = $relacao->dados;
        }
        return $dados;
    }

    public function emailRelacao(){
        return $this->hasOne('app\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','cliente')
            ->where('tabela_destino','email');
    }

    public function email(){
        return $this->emailRelacao->dados();
    }

}
