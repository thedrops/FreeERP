@extends('template')
@section('title', 'Cadastrar Juridico')

@section('content')
<form>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Nome">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Nome Fantasia">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="CNPJ">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="IE">
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="E-mail">
    </div>
    <br>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Telefone">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Celular">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Telefone (opcional)">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Celular (opcional)">
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="UF">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Cidade">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Endereço">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Complemento">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Bairro">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="CEP">
    </div>
  </div>



@endsection