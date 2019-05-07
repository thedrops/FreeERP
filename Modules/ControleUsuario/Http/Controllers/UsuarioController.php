<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\controleUsuario\Entities\Papel;
use Modules\controleUsuario\Http\Requests\{ValidaLoginRequest};
use Modules\controleUsuario\Http\Requests\{ValidaCadastroRequest};
use Modules\ControleUsuario\Entities\{Usuario};
use DB;
use PHPUnit\Runner\Exception;
use Illuminate\Support\Facades\Hash;

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
                    ['icon' => 'person', 'tool' => 'Autenticar', 'route' => '/controleusuario/autenticar'],
                    ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/controleusuario/cadastrar'],
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
        return $this->viewAutenticar(); 
    }

    public function viewAutenticar() {
        return view('controleusuario::login',$this->dadosTemplate);
    }

    public function viewCadastro() {
        return view('controleusuario::cadastrar',$this->dadosTemplate);
    }

    
    
    public function autenticar(ValidaLoginRequest $req)
    {        
        try{
            \Auth::attempt($req->only(['email','password']), false);
            return redirect()->route('index');
        }catch(\Exception $ex){
            return $ex->getMessage();
        } 
    }
    
    public function cadastrar(Request $req)
    {
        try{
            $data = $req->all();
            $data['password'] =base64_encode($req->input('password'));            
            Usuario::Create($data);

            return back()->with('success', 'Usuário cadastrado com sucesso!');
        }catch(Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e);
        }
    }

    public function validaLogin(ValidaLoginRequest $req){  
        $senha=  base64_encode($req->password);
        $user = DB::table('usuario')->where('email', $req->email)->Where('password',$senha)->first();
        if($user!=null){
            session_start();
            echo "bem vindo " . $user->name;
            $_SESSION['id'] =$user->id;
            $_SESSION['email']= $user->email;
          $data=['usuario'=>$user,'url'=>'/','title'=>'Pagina inicial'];
          return view('controleusuario::index',$this->dadosTemplate, compact('data'));
          
        }else{
          echo "usuario não encontrado<br>";
          }
          
     }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
                /** 
         * Validar campos recebidos do request - ok
         * inserir dados no db - ok
         * retornar para tela de cadastro com feedback de sucesso ou erro - ok
        */
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {




        
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
        $status = ['0'=>"Ativo e inativos", '1'=>"Somente ativos",'2'=>"Somente inativos"];
        $modulos = ['0'=>"Todos os módulos",'1'=>"Recursos Humanos", '2'=>"Vendas",'3'=>"Estoque"];
        $cargos = ['0'=>"Administradores",'1'=>"Gerentes",'2'=> "operadores"];
        return view('controleusuario::consulta', $this->dadosTemplate, compact('status','modulos', 'cargos'));
    }

    public function buscar(Request $req){
        
        dd($req);

        return view('controleusuario::consulta', $this->dadosTemplate, compact('status'));
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