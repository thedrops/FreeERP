@extends('contaapagar::layouts.master')

@section('css')
    <style>
        .teste {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
        #novo {
            margin-right: 2.5px;
        }
        
        #dropdownMenuButton{
            margin-left: 2.5px;
        }
        
        .check {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
    </style>
@stop
@section('content')
    <h1>Despesa prevista no período</h1>
    
<header> 
    <div class="row" style="padding-left: 15px;">
        <div class="card col-sm-2 d-flex align-items-center align-content-center"><h3>R${{$total}}</h3></div>
    </div>
    <div class="row teste" style="padding-top: 50px;">

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nova Conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('conta.cadastrar')}}" method="POST">
                        {{csrf_field()}}
                        @include('contaapagar::_formConta')
                    </form>
                </div>
                
            </div>
        </div>
    </div>
     <div class="col-11 padding-left: 15px;">
        <form class="row" action="{{route('conta.filtrar')}}" method="POST")>
            {{csrf_field()}}
            @include('contaapagar::_formFiltro')   
        </form>
    </div>
    <div class="col-1"> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Nova</button>
    </div>
    </div>
</header>    
<br>
        
  
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data de Vencimento</th>
                <th scope="col">Data de Pagamento</th>
                <th scope="col">Multa</th>
                <th scope="col">Juros</th>
                <th scope="col">Valor</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Detalhes</th>
                
            </tr>
        </thead>
        <tbody>
           @foreach ($pagamentos as $pagamento)
            <tr>
                    <td>{{$pagamento->nome()}}</td>
                    <td>{{$pagamento->categoria()}}</td>
                    <td>{{$pagamento->data_vencimento}}</td>
                    <td>{{$pagamento->data_pagamento}}</td>
                        <td>R${{$pagamento->juros}}</td>
                        <td>R${{$pagamento->multa}}</td>
                        <td>R${{$pagamento->valor}}</td>
                        <td>R${{($pagamento->juros + $pagamento->multa + $pagamento->valor)}}</td>
                    <td>{{$pagamento->status_pagamento }}</td>
                    <td><a href="{{route('conta.editar', $pagamento->conta_pagar_id)}}" ><i class='material-icons'>search</i></a> <a href="{{Route('conta.deletar', $pagamento->conta_pagar_id)}}"><i class='material-icons'>delete</i></a></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$pagamentos->currentPage()}} de {{$pagamentos->lastPage()}}
                    - Exibindo {{$pagamentos->perPage()}} registro(s) por página de {{$pagamentos->total()}}
                    registro(s) no total
                </p>
                </td>     
            </tr>
            @if($pagamentos->lastPage() > 1)
            <tr>
                <td colspan="100%">
                {{ $pagamentos->links() }}
                </td>
            </tr>
            @endif
        </tfoot>        
    </table>
</div>
    





@stop