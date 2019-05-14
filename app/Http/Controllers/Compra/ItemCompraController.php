<?php

namespace App\Http\Controllers\Compra;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Compra\ItemCompra;

class ItemCompraController extends Controller
{

    public function index()
    {
        $data = [
			'item_compra'		=> ItemCompra::all(),
			'title'				=> "Lista de Itens",
		]; 
			
	    return view('compra.index', compact('data'));
    }

    public function create()
    {
        $data = [
			"url" 	 	=> url('itemCompra'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Item Compra"
		];
	    return view('compra.formulario', compact('data'));

    }

    public function store(Request $request)
    {
		DB::beginTransaction();
		try{
			$itemCompra = ItemCompra::Create($request->all());
			DB::commit();
			return redirect('/itemCompra')->with('success', 'Item cadastrado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    
    public function show($id)
    {
        $itemCompra = ItemCompra::findOrFail($id);
	    return view('compra.show', [
            'model' => $itemCompra	    
        ]);
    
    }

    public function edit($id)
    {
        $data = [
			"url" 	 	=> url("itemCompra/$id"),
			"button" 	=> "Atualizar",
			"model"		=> ItemCompra::findOrFail($id),
			'title'		=> "Atualizar Item Compra"
		];
	    return view('compra.formulario', compact('data'));
        
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
			$itemCompra = ItemCompra::findOrFail($id);
			$itemCompra->update($request->all());
			DB::commit();
			return redirect('/itemCompra')->with('success', 'Item atualizado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
        
    }

    public function destroy($id)
    {
        $itemCompra = ItemCompra::findOrFail($id);
		$itemCompra->delete();
		return back()->with('success',  'Item deletado');    
        
    }
}