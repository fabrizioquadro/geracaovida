@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretária Atividades</h4>
            <a href="{{ route('secretaria.atividades.adicionar') }}" class="btn btn-primary">Adicionar</a>
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
                        <th>Data</th>
                        <th>Ministerio</th>
                        <th>Atividade</th>
                        <th>Situação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach($atividades as $atividade)
                        @php
                        $var = explode(' ', $atividade->dt_hr_culto);
                        $data_atividade = dataDbForm($var[0])." ".$var[1];
                        @endphp
                        <tr>
                            <td> <span style='display:none'>{{ $atividade->dt_hr_culto }}</span> {{ $data_atividade }}</td>
                            <td>{{ $atividade->ministerio->nm_ministerio }}</td>
                            <td>{{ $atividade->nm_culto }}</td>
                            <td>{{ $atividade->st_culto }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <a class="dropdown-item waves-effect" href="{{ route('secretaria.atividades.editar', $atividade->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('secretaria.atividades.excluir', $atividade->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
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
    order: [[0, 'asc']],
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
