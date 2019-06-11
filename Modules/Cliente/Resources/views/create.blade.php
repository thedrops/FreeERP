@extends('template')
@section('title', 'Cadastrar Juridico')

@section('content')
<form action="{{url('/cliente/store')}}" method="POST">
  @csrf
  <div class="row">
    <div class="col">
      <input type="text" name="nome" class="form-control" placeholder="Nome Completo">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      Data de Nascimento: <input type="text" name="data_nascimento" class="form-control" placeholder="Data de Nascimento">
    </div>
    <div class="col invisible">
    </div>
    <div class="col invisible">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="cpf" class="form-control" placeholder="CPF">
    </div>
    <div class="col invisible">
    </div>
    <div class="col invisible">
    </div>
    <!-- arrumar isso -->
    <div class="col">
    <div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
  <label class="custom-control-label" for="customRadioInline1">Masculino</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
  <label class="custom-control-label" for="customRadioInline2">Feminino</label>
</div>
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="email" name="email" class="form-control" placeholder="E-mail">
    </div>
    <div class="col invisible">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="telefone" class="form-control" placeholder="Telefone">
    </div>
    <div class="col">
      <input type="text" name="celular" class="form-control" placeholder="Celular">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="telefone2" class="form-control" placeholder="Telefone (opcional)">
    </div>
    <div class="col">
      <input type="text" name="celular2" class="form-control" placeholder="Celular (opcional)">
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="uf" class="form-control" placeholder="UF">
    </div>
    <div class="col">
      <input type="text" name="cidade" class="form-control" placeholder="Cidade">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="endereco" class="form-control" placeholder="Endereço">
    </div>
    <div class="col">
      <input type="text" name="complemento" class="form-control" placeholder="Complemento">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="bairro" class="form-control" placeholder="Bairro">
    </div>
    <div class="col">
      <input type="text" name="cep" class="form-control" placeholder="CEP">
    </div>
  </div>
  <input type="submit" />
</form>


@endsection