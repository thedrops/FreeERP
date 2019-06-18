@extends('template')
@section('title', 'Cadastrar Fisico')

@section('content')
<head>
    <title>Document</title>
    <!-- <script src = "https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form action="{{url('/cliente/store')}}" method="POST">
  @csrf
  <div class="row">
    <div class="col">
      <input type="text" name="nome" id="name" class="form-control" placeholder="Nome Completo">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
       <!-- <label for = "date">Data de Nascimento</label> -->
       <input type="text" name="data_nascimento" id="date" class="form-control date" placeholder="Data de Nascimento">
    </div>
    <div class="col invisible">
    </div>
    <div class="col invisible">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF">
    </div>
    <div class="col invisible">
    </div>
    <div class="col invisible">
    </div>
    <!-- 1 = Masculino | 2 = Feminino -->
    <div class="col">
    <div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline1" value=1 name="customRadioInline1" class="custom-control-input">
  <label class="custom-control-label" for="customRadioInline1">Masculino</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" value=0 name="customRadioInline1" class="custom-control-input">
  <label class="custom-control-label" for="customRadioInline2">Feminino</label>
</div>
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
    </div>
    <div class="col invisible">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone">
    </div>
    <div class="col">
      <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="telefone2" id="telefone2" class="form-control" placeholder="Telefone (opcional)">
    </div>
    <div class="col">
      <input type="text" name="celular2" id="celular2" class="form-control" placeholder="Celular (opcional)">
    </div>
    
  </div>
  <br>
  <div class="row">
    <div class="col">
      <select name="uf" class="form-control">
                <option value = "AC">Acre</option>
                <option value = "AL">Alagoas</option>
                <option value = "AP">Amapá</option>
                <option value = "AM">Amazonas</option>
                <option value = "BA">Bahia</option>
                <option value = "CE">Ceará</option>
                <option value = "DF">Distrito Federal</option>
                <option value = "ES">Espírito Santo</option>
                <option value = "GO">Goiás</option>
                <option value = "MA">Maranhão</option>
                <option value = "MT">Mato Grosso</option>
                <option value = "MS">Mato Grosso do Sul</option>
                <option value = "MG">Minas Gerais</option>
                <option value = "PA">Pará</option>
                <option value = "PB">Paraíba</option>
                <option value = "PR">Paraná</option>
                <option value = "PE">Pernambuco</option>
                <option value = "PI">Piauí</option>
                <option value = "RJ">Rio de Janeiro</option>
                <option value = "RN">Rio Grande do Norte</option>
                <option value = "RS">Rio Grande do Sul</option>
                <option value = "RO">Rondônia</option>
                <option value = "RR">Roraima</option>
                <option value = "SC">Santa Catarina</option>
                <option value = "SP">São Paulo</option>
                <option value = "SE">Sergipe</option>
                <option value = "TO">Tocantins</option>
          </select>
    </div>
    <div class="col">
      <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço">
    </div>
    <div class="col2">
      <input type="text" name="numero" id="numero" class="form-control" placeholder="Nº">
    </div>
    <div class="col">
      <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Complemento">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro">
    </div>
    <div class="col">
      <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP">
    </div>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<!-- <script>
  $(Document).ready(function(){
  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
  $('.phone_us').mask('(000) 000-0000');
  $('.mixed').mask('AAA 000-S0S');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('.money2').mask("#.##0,00", {reverse: true});
  $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true
      }
    }
  });
  $('.ip_address').mask('099.099.099.099');
  $('.percent').mask('##0,00%', {reverse: true});
  $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  $('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });
  $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});
</script> -->
</body>
@endsection