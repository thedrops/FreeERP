<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\ClienteFisico;
use App\Entities\{Relacao, Documento, Email, Telefone};

class ClienteController extends Controller
{   
    public function __construct() {
        $menu = [
            ['icon' => 'person_add', 'tool' => 'Cadastro Fisico', 'route' => 'cadastrar'],
            ['icon' => 'work', 'tool' => 'Cadastro Juridico', 'route' => 'juridico'],

        ];

        $this->dadosTemplate = [
            'moduleInfo' => [
                'icon' => 'face',
                'name' => 'Cliente'
            ],
            'menu' => $menu,
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cliente::index', $this->dadosTemplate);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cliente::create', $this->dadosTemplate);
    }

    public function juridico()
    {
        return view('cliente::juridico', $this->dadosTemplate);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        //Cliente
        $dadosCliente = [
            'nome'              => $request->nome,
            'data_nascimento'   => $request->data_nascimento,
            'sexo'              => $request->customRadioInline1,
            'tipo_cliente_id'   => 0
        ];
        
        $cliente = ClienteFisico::create($dadosCliente);

        //CPF
        $cpf = [
            'tipo_documento_id' => 1,
            'numero' => $request->cpf
        ];

        $documento = Documento::create($cpf);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'documento',
            'destino_id' => $documento->id,
            'modelo' => 'Documento'
        ]);

        //EMAIL
        $email = [
            'email' => $request->email
        ];

        $enderecoEmail = Email::create($email);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'email',
            'destino_id' => $enderecoEmail->id,
            'modelo' => 'Email'
        ]);

        //TELEFONE
        $telefone = [
            'numero' => $request->telefone,
            'tipo_id'  => 1
        ];

        $telefoneUm = Telefone::create($telefone);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'telefone',
            'destino_id' => $telefoneUm->id,
            'modelo' => 'Telefone'
        ]);

        //TELEFONE 2
        $telefone2 = [
            'numero' => $request->telefone2,
            'tipo_id'  => 1
        ];

        $telefoneDois = Telefone::create($telefone2);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'telefone',
            'destino_id' => $telefoneDois->id,
            'modelo' => 'Telefone'
        ]);

        //CELULAR
        $celular = [
            'numero' => $request->celular,
            'tipo_id'  => 2
        ];

        $celularUm = Telefone::create($celular);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'telefone',
            'destino_id' => $celularUm->id,
            'modelo' => 'Telefone'
        ]);

        //CELUALR2
        $celular2 = [
            'numero' => $request->celular2,
            'tipo_id'  => 2
        ];

        $celularDois = Telefone::create($celular2);

        Relacao::create([
            'tabela_origem' => 'cliente',
            'origem_id' => $cliente->id,
            'tabela_destino' => 'telefone',
            'destino_id' => $celularDois->id,
            'modelo' => 'Telefone'
        ]);

        return back()->with("success", "O cliente foi cadastrado com sucesso!");

        // $cliente->nome = 'Fernando';
        // $cliente->nascimento = '2004-04-05';
        // $cliente->sexo = 'M';
        // $cliente->tipo_cliente_id = 0;

        // $cliente->save();

        // $cpf = [
        //     'tipo' => 'cpf',
        //     'numero' => $request->cpf
        // ];
        
        // $cliente->documentos()->create($cpf);

        // new Relacao::create([
        //     'tabela_origem' => 'cliente',
        //     'origem_id' => $cliente->id
        // ])
        // $cliente->cpf = $request->cpf;
        // $cliente->email = $request->email;
        // $cliente->telefone = $request->telefone;
        // $cliente->telefone2 = $request->telefone2;
        // $cliente->celular = $request->celular;
        // $cliente->celular2 = $request->celular2;
        // $cliente->uf = $request->uf;
        // $cliente->cidade = $request->cidade;
        // $cliente->endereco = $request->endereco;
        // $cliente->complemento = $request->complemento;
        // $cliente->bairro = $request->bairro;
        // $cliente->cep = $request->cep;

        // dd($cliente);

        // dd($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cliente::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cliente::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
