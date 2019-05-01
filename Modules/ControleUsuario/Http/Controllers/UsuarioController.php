<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\controleUsuario\Http\Requests\{ValidaLoginRequest};

class UsuarioController extends Controller
{
    protected $dadosTemplate;

    public function __construct() {

        /* Inicializa com o icone e nome padrao */

        // $papel = Papel::find()->where('idUsuario', '=', $idUsuario);
        $papel = 'administrador';
        $menu = [];

        switch ($papel) {
            case 'administrador':
                $menu = [
                    ['icon' => 'person', 'tool' => 'Login', 'route' => '/controleusuario/login'],
                    ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
                    ['icon' => 'search', 'tool' => 'Buscar', 'route' => '/controleusuario/consulta'],
                    ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
                    ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
                ];
            break;
            default: $menu = [];
        }

        $this->dadosTemplate = [
            'moduleInfo' => [
                'icon' => 'person',
                'name' => 'Controle de Usuario'
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
        return view('controleusuario::cadastrar', $this->dadosTemplate);
    }

    public function autenticacao()
    {
        return view('controleusuario::login', $this->dadosTemplate);
    }
    public function login(){
        $data = ['url'=>'validar.login','title'=>'Pagina de login'];
        return view('controleusuario::login',$this->dadosTemplate,compact('data'));
    }
    
    public function validaLogin(ValidaLoginRequest $req){        
        try{
            \Auth::attempt($req->only(['email','password']), false);
            return redirect()->route('user.dashboard');
        }catch(\Exception $ex){
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
                /** 
         * Validar campos recebidos do request
         * inserir dados no db
         * retornar para tela de cadastro com feedback de sucesso ou erro
        */
        return view('cadastrar.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            

        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('controleusuario::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('controleusuario::edit');
    }

    public function consulta(){

        return view('controleusuario::consulta', $this->dadosTemplate);
    }

    public function buscar(){

        return view('controleusuario::consulta', $this->dadosTemplate);
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
