@extends('template')
@section('content')
    
    
    <div class="float-right" style="margin-bottom:10px;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#nova_vaga" >
    Nova Vaga</button></div>
        <!-- Modal Create -->
        <div class="modal fade" id="nova_vaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Vaga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{url('recrutamento/Vaga')}}" method="POST">
                {{ csrf_field() }}
               

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="cargo" class="control-label">Cargo</label>
                            <input type="text" name="cargo" id="cargo" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="numero_vagas" class="control-label">Número de Vagas</label>
                            <input type="number" name="quantidade" id="numero_vagas" class="form-control" >
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="salario" class="control-label">Salário</label>
                            <input type="text" maxlength="10" min='0' name="salario" id="money" class="form-control money" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="escolaridade">Escolaridade</label>
                            <select class="form-control" id="escolaridade" name='escolaridade'>
                                <option value=''>Escolha uma opção</option>
                                <option value='fundamental'>Ensino Fundamental</option>
                                <option value='medio'>Ensino Médio</option>
                                <option value='tecnico'>Ensino Técnico</option>
                                <option value='superior'>Ensino Superior</option>
                            </select>
                        </div>
        
                        <div class="form-group col-sm-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name='status'>
                                <option value=''>Escolha uma opção</option>
                                <option value='iniciado'>Iniciado</option>
                                <option value='disponivel'>Disponível</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                                <label for="descricao" class="control-label">Descrição da Vaga</label>
                                <textarea class="form-control"  name="descricao" id="descricao" rows="3"></textarea>
                        </div>
                    </div>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar Vaga</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <!-- End Modal Create -->




    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vaga'] as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cargo}}</td>
                        <td>
                            <form action="{{url('recrutamento/Vaga', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("recrutamento/Vaga/$item->id/edit") }}'>Editar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('js')
<script>
$('.money').mask('000.000,00', {reverse: true});
</script>
@endsection