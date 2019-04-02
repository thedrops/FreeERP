<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CadastroFuncionario extends FormRequest{

    public function rules(){
        return [
            'funcionario.nome'              => 'required|max:100',
            'funcionario.dataNascimento'    => 'required|date_format:"d/m/Y"',
            'funcionario.sexo'              => 'required',
            'funcionario.estado_civil_id'   => 'required',
            'funcionario.cargo_id'          => 'required',
            'funcionario.dataAdmissao'      => 'required|date_format:d/m/Y',
            'endereco.logradouro'           => 'required|max:255',
            'endereco.numero'               => 'required|number|max:5',
            'endereco.bairro'               => 'required|max:100',
            'endereco.cidade'               => 'required|max:100',
            'endereco.uf'                   => 'required|max:2',
            'endereco.cep'                  => 'regex:^[0-9]{5}-[0-9]{3}$',
            'endereco.complemento'          => 'max:255',
            'contato.email'                 => 'required|email',
        ];
    }

    public function messages(){
        return [
        ];
    }
}