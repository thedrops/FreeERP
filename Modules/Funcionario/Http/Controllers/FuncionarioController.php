<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Cargo, Funcionario};
use App\Entities\{EstadoCivil, Documento, Telefone, TipoDocumento, Relacao, Cidade, Estado, TipoTelefone, Endereco, Email};
use Modules\Funcionario\Http\Requests\CreateFuncionario;
use DB;

class FuncionarioController extends Controller{
    
    public function index(){
        $data = [
            'title' => 'Lista de Funcionários',
            'funcionarios' => Funcionario::paginate(10)
        ];

        return view('funcionario::funcionario.index', compact('data'));
    }

    public function list(Request $request, $status) {
        $funcionarios = new Funcionario;

        if($request['pesquisa']) {
            $funcionarios = $funcionarios->where('nome', 'like', '%'.$request['pesquisa'].'%');
        }

        if($status == 'inativos'){
            $funcionarios = $funcionarios->onlyTrashed();
        }

        $funcionarios = $funcionarios->paginate(10);

        return view('funcionario::funcionario.table', compact('funcionarios', 'status'));
    }
    
    public function create(){
        $data = [
            'url'               => url("funcionario/funcionario"),
            'model'             => '',
            'tipo_documentos'   => TipoDocumento::whereNotIn('id', [1,2])->get(),
            'documentos'        => [new Documento],
            'telefones'         => [new Telefone],
            'tipos_telefone'    => TipoTelefone::all(),
            'estado_civil'      => EstadoCivil::all(),
            'estados'           => Estado::all(),
            'cidades'           => Cidade::all(),
            'cargos'            => Cargo::all(),
            'title'             => 'Cadastro de Funcionário',
            'button'            => 'Salvar',
        ];

        return view('funcionario::funcionario.form', compact('data'));
    }

    public function store(CreateFuncionario $request){

        DB::beginTransaction();
		try{

            $funcionario = Funcionario::create($request->input('funcionario'));

            $funcionario->cargos()->attach(
                $request['cargo']['cargo_id'],
                ['data_entrada' => implode('-', array_reverse(explode('/', $request['funcionario']['data_admissao']))) ? : '']
            );

            Relacao::create([
                'tabela_origem'     => 'funcionario',
                'origem_id'         => $funcionario->id,
                'tabela_destino'    => 'estado_civil',
                'destino_id'        => $request->funcionario['estado_civil_id'],
                'modelo'            => 'EstadoCivil'
            ]);

            foreach($request->documentos as $key => $documento) {

                $newDoc = [
                    'tipo_documento_id'     => $documento['tipo_documento_id'],
                    'numero'                => $documento['numero']
                ];

                $doc = Documento::create($newDoc);

                Relacao::create([
                    'tabela_origem'     => 'funcionario',
                    'origem_id'         => $funcionario->id,
                    'tabela_destino'    => 'documento',
                    'destino_id'        => $doc->id,
                    'modelo'            => 'Documento'
                ]);

            }
            
            if($request->input('docs_outros')) {

                foreach($request->docs_outros as $documento) {

                    if(isset($documento['comprovante'])) {

                        $nome = uniqid(date('HisYmd'));
                        $extensao = $documento['comprovante']->extension();
                        $nomeArquivo = "{$nome}.{$extensao}";
                        $upload = $documento['comprovante']->storeAs('funcionario/documentos', $nomeArquivo);

                        if (!$upload) {
                            return redirect()->back()->with('warning', 'Falha ao fazer upload de comprovante de documento')->withInput();
                        }

                        $documento['comprovante'] = $nomeArquivo;
                    
                    }
                
                    $doc = Documento::create($documento);

                    Relacao::create([
                        'tabela_origem'     => 'funcionario',
                        'origem_id'         => $funcionario->id,
                        'tabela_destino'    => 'documento',
                        'destino_id'        => $doc->id,
                        'modelo'            => 'Documento'
                    ]);

                }
            }

            $endereco = Endereco::create($request->input('endereco'));

            Relacao::create([
                'tabela_origem'     => 'funcionario',
                'origem_id'         => $funcionario->id,
                'tabela_destino'    => 'endereco',
                'destino_id'        => $endereco->id,
                'modelo'            => 'Endereco'
            ]);

            $email = Email::create(['email' => $request->email]);

            Relacao::create([
                'tabela_origem'     => 'funcionario',
                'origem_id'         => $funcionario->id,
                'tabela_destino'    => 'email',
                'destino_id'        => $email->id,
                'modelo'            => 'Email'
            ]);

            foreach($request->telefones as $telefone) {
           
                $telefone = Telefone::create($telefone);

                Relacao::create([
                    'tabela_origem'     => 'funcionario',
                    'origem_id'         => $funcionario->id,
                    'tabela_destino'    => 'telefone',
                    'destino_id'        => $telefone->id,
                    'modelo'            => 'Telefone'
                ]);

            }

			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Funcionário cadastrado com successo!');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
   
    public function show($id){
       
    }

    public function edit($id){

        $funcionario = Funcionario::findOrFail($id);

        $documentos = Documento::whereNotIn('tipo_documento_id', [1,2])->join('relacao','documento.id','=','relacao.destino_id')->where('relacao.origem_id',$id)->where('relacao.tabela_origem','funcionario')->get();

        $data = [
            "url" 	 	        => url("funcionario/funcionario/$id"),
            "model"		        => $funcionario,
            'tipo_documentos'   => TipoDocumento::whereNotIn('id', [1,2])->get(),
            'documentos'        => count($documentos) ? $documentos : [new Documento],
            'tipos_telefone'    => TipoTelefone::all(),
            'estado_civil'      => EstadoCivil::all(),
            'telefones'         => $funcionario->telefones(),
            'estados'           => Estado::all(),
            'cidades'           => Cidade::where('estado_id', $funcionario->endereco()->cidade->estado_id)->get(),
            'cargos'            => Cargo::all(),
            'title'		        => "Atualizar Funcionário",
			"button" 	        => "Atualizar",
        ];

	    return view('funcionario::funcionario.form', compact('data'));
    }

    public function update(CreateFuncionario $request, $id){

        DB::beginTransaction();
		try{

            $funcionario = Funcionario::findOrFail($id);

            $funcionario->update($request->input('funcionario'));

            $funcionario->estadoCivilRelacao()->update(['destino_id' => $request->funcionario['estado_civil_id']]);

            foreach($request->documentos as $key => $documento) {
                Documento::find($documento['id'])->update($documento);
            }

            $funcionario->endereco()->update($request->input('endereco'));

            //remoção de documentos

            $documentosRequestIds = [];

            if($request->input('docs_outros')) {
                foreach($request->input('docs_outros') as $documento) {
                    if(isset($documento['id'])) {
                        $documentosRequestIds[] = $documento['id'];
                    }
                }          
            }

            $documentosFuncionarioIds = [];

            foreach($funcionario->documentos() as $documento) {
                if($documento->tipo_documento_id != 1 && $documento->tipo_documento_id != 2){
                    $documentosFuncionarioIds[] = $documento->id;
                }
            }
            
            $documentosRemovidos = array_diff($documentosFuncionarioIds, $documentosRequestIds);

            if(count($documentosRemovidos) > 0) {
                foreach($documentosRemovidos as $documentoId) {
                    Documento::find($documentoId)->delete();
                    Relacao::where('tabela_origem','funcionario')->where('origem_id',$funcionario->id)->where('tabela_destino','documento')->where('destino_id',$documentoId)->delete();
                }
            }
            //####################

            if($request->input('docs_outros')) {

                foreach($request->input('docs_outros') as $documento){
                    if(isset($documento['id'])) {
                        Documento::find($documento['id'])->update($documento);
                    } else {

                        if(isset($documento['comprovante'])) {

                            $nome = uniqid(date('HisYmd'));
                            $extensao = $documento['comprovante']->extension();
                            $nomeArquivo = "{$nome}.{$extensao}";
                            $upload = $documento['comprovante']->storeAs('funcionario/documentos', $nomeArquivo);
            
                            if (!$upload) {
                                return redirect()->back()->with('warning', 'Falha ao fazer upload de comprovante de documento')->withInput();
                            }
            
                            $documento['comprovante'] = $nomeArquivo;

                        }

                        $documento = Documento::create($documento);

                                            
                        Relacao::create([
                            'tabela_origem'     => 'funcionario',
                            'origem_id'         => $funcionario->id,
                            'tabela_destino'    => 'documento',
                            'destino_id'        => $documento->id,
                            'modelo'            => 'Documento'
                        ]);
                    }
                }
            }

            //remoção de telefones
            foreach($request->input('telefones') as $telefone) {
                $telefonesRequestIds[] = $telefone['id'];
            }

            foreach($funcionario->telefones() as $telefone) {
                $telefonesFuncionarioIds[] = $telefone->id;
            }

            $telefonesRemovidos = array_diff($telefonesFuncionarioIds, $telefonesRequestIds);

            if(count($telefonesRemovidos) > 0) {
                foreach($telefonesRemovidos as $telefoneId) {
                    Telefone::find($telefoneId)->delete();
                    Relacao::where('tabela_origem','funcionario')->where('origem_id',$funcionario->id)->where('tabela_destino','telefone')->where('destino_id',$telefoneId)->delete();
                }
            }
            //####################

            foreach($request->input('telefones') as $telefone){
                if($telefone['id'] != null)
                    Telefone::find($telefone['id'])->update($telefone);
                else {
                    $telefone = Telefone::create($telefone);
                    
                    Relacao::create([
                        'tabela_origem'     => 'funcionario',
                        'origem_id'         => $funcionario->id,
                        'tabela_destino'    => 'telefone',
                        'destino_id'        => $telefone->id,
                        'modelo'            => 'Telefone'
                    ]);
                }
            }

			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Funcionário atualizado com successo!');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
    
    public function destroy($id){
        $funcionario = Funcionario::withTrashed()->findOrFail($id);

        if($funcionario->trashed()) {
            $funcionario->restore();
            return back()->with('success', 'Usuário ativado com sucesso!');
        } else {
            $funcionario->delete();
            return back()->with('success', 'Usuário desativado com sucesso!');
        }
    }

    public function ficha($id){
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario::funcionario.ficha', compact('funcionario'));
    }

    public function getCidades($uf) {

        $estado = Estado::where('nome', $uf)->first();

        $cidades = Cidade::where('estado_id', $estado->id)->select('id', 'nome')->get();

        if(count($cidades) > 0){
            return $cidades;
        }          
 
    }

    public function editCargo($id){
        $funcionario = Funcionario::findOrFail($id);
        $cargoAtual = $funcionario->cargos->last()->id;
        $data = [
            'url'               => url("funcionario/funcionario/editCargo/$id"),
            'model'             => $funcionario,
            'cargos'            => Cargo::where('id','<>',$cargoAtual)->get(),
            'title'             => 'Edição de cargos',
            'button'            => 'Salvar',
        ];

        return view('funcionario::funcionario.cargo', compact('data'));
    }

    public function updateCargo($id, Request $request){
        DB::beginTransaction();
		try{
            $funcionario = Funcionario::findOrFail($id);
            $data = implode('-', array_reverse(explode('/', $request['cargo']['data_entrada'])));
            $cargo = $funcionario->cargos->last();
            $cargo->pivot->data_saida = $data;
            $cargo->pivot->update();
            
            $funcionario->cargos()->attach(
                $request['cargo']['cargo_id'],
                ['data_entrada' => $data]
            );
            
			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Cargo do funcionário atualizado com successo!');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }

}
