@extends('contaapagar::layouts.master')


@section('content')
    <div class="card ">
        <div class="card-body ">
            <form action="{{route('conta.cadastrar')}}" method="POST">
                {{csrf_field()}}
                @include('contaapagar::_formConta')
                
            </form>
        </div>
    </div>
    
    

@stop
