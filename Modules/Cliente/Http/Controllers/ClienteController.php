<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ClienteController extends Controller
{   
    public function __construct() {
        $menu = [
            ['icon' => 'person_add', 'tool' => 'Cadastro Fisico', 'route' => '/cliente/cadastrar'],
            ['icon' => 'work', 'tool' => 'Cadastro Juridico', 'route' => '/cliente/juridico'],

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
        //
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
