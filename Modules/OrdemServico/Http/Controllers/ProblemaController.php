<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    Problema
};
use DB;

class ProblemaController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Listagem de Problemas',
            'model' => Problema::paginate(5),
            'atributos' => ['titulo','descricao','prioridade'],
            'route' => 'modulo.problema.',
            'cadastro' => '',
            'acoes' => ''
        ];

        return view('ordemservico::layouts.index', compact('data'));
    }

    public function create()
    {
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $problema = Problema::create($request->problema());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {
    }
 
    public function edit($id)
    {
    }
 
    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
   
}

