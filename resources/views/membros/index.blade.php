@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">{{ $situacao }}</h4>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    Adicionar
                </button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Homem']) }}">Homem</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Mulher']) }}">Mulher</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Casal']) }}">Casal</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Jovem']) }}">Jovem</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Adolescente']) }}">Adolescente</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Pré-adolescente']) }}">Pré-adolescente</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Criança']) }}">Criança</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Infantil A']) }}">Infantil A</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Infantil B']) }}">Infantil B</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', [$situacao,'Berçário']) }}">Berçário</a></li>
                </ul>
            </div>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="table-responsive">
            <table class="datatables-products table" id="table-index">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Genero</th>
                        <th>Conjugue</th>
                        <th>Idade</th>
                        <th>Batismo</th>
                        <th>Fone</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach($membros as $membro)
                        @php
                        if($membro->dt_nascimento){
                            $hoje = date('Y-m-d');
                            $dias = (strtotime($hoje) - strtotime($membro->dt_nascimento)) / 86400;
                            $idade = round($dias / 365). " ano(s)";
                        }
                        else{
                            $idade = null;
                        }
                        if($membro->foto){
                            $avatar = "/public/img/membros/$membro->foto";
                        }
                        elseif($membro->genero == "Homem"){
                            $avatar = '/public/template/img/avatars/1.png';
                        }
                        elseif($membro->genero == "Mulher"){
                            $avatar = '/public/template/img/avatars/2.png';
                        }
                        else{
                            $avatar = '/public/img/icons/crianca.png';
                        }
                        @endphp
                        <tr>
                            <td><img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt=""></td>
                            <td>{{ $membro->nome }}</td>
                            <td>{{ $membro->genero }}</td>
                            <td>{{ $membro->conjugue() ? $membro->conjugue()->nome : '' }}</td>
                            <td>{{ $idade }}</td>
                            <td>{{ $membro->data_batismo ? dataDbForm($membro->data_batismo) : '' }}</td>
                            <td>{{ $membro->fone }}</td>
                            <td>{{ $membro->email }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <a class="dropdown-item waves-effect" href="{{ route('membros.editar', $membro->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('membros.excluir', $membro->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('membros.visualizar', $membro->id) }}"><i class="mdi mdi-eye me-1"></i> Visualizar</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('membros.familia', $membro->id) }}"><i class="mdi mdi-account-group me-1"></i> Familia</a>
                                        @if($membro->situacao == "Primeiras Visitas")
                                            <a class="dropdown-item waves-effect" href="{{ route('membros.enviar_visitas_frequentes', $membro->id) }}"><i class="mdi mdi-chevron-right me-1"></i> Enviar p/ Visitantes Frequentes</a>
                                        @endif
                                        @if($membro->situacao != "Membro")
                                            <a class="dropdown-item waves-effect" href="{{ route('membros.batizar', $membro->id) }}"><i class="mdi mdi-chevron-double-right me-1"></i> Batizar</a>
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[1, 'asc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

</script>
@endsection
