@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros</h4>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    Adicionar
                </button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', 'individual') }}">Individual</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', 'crianca') }}">Criança</a></li>
                    <li><a class="dropdown-item waves-effect" href="{{ route('membros.adicionar', 'familia') }}">Familia</a></li>
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
            <table class="tabela" id="table-index">
                <thead class="table-bordered">
                    <tr>
                        <th></th>
                        <th class='text-center'><strong>Nome</strong></th>
                        <th class='text-center'><strong>Genero</strong></th>
                        <th class='text-center'><strong>Nascimento</strong></th>
                        <th class='text-center'><strong>Batismo</strong></th>
                        <th class='text-center'><strong>Fone</strong></th>
                        <th class='text-center'><strong>Email</strong></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach($membros as $membro)
                        @php
                        if($membro->foto){
                            $avatar = "/public/img/membros/$membro->foto";
                        }
                        elseif($membro->genero == "Masculino"){
                            $avatar = '/public/template/img/avatars/1.png';
                        }
                        else{
                            $avatar = '/public/template/img/avatars/2.png';
                        }
                        @endphp
                        <tr>
                            <td><img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt=""></td>
                            <td>{{ $membro->nome }}</td>
                            <td>{{ $membro->genero }}</td>
                            <td>{{ $membro->dt_nascimento ? dataDbForm($membro->dt_nascimento) : '' }}</td>
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
