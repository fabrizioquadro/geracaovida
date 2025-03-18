@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Atendimentos</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-4" style="border-right: 1px solid #cdcdcd">
                <div class="list-group">
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action active waves-effect disabled">Apresentação</a>
                    <a href="{{ route('agendas') }}" class="list-group-item list-group-item-action waves-effect">Agenda</a>
                    <a href="{{ route('agendas.lista_atendimentos') }}" class="list-group-item list-group-item-action waves-effect">Todos os Atendimentos</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-border-shadow-primary mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatables-products table" id="table-index">
                                <thead class="table-light">
                                    <tr>
                                        <th>Data</th>
                                        <th>Tempo</th>
                                        <th>Tipo</th>
                                        <th>Participantes</th>
                                        <th>Situação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                    @foreach($reunioes as $reuniao)
                                        @php
                                        $var = explode(' ', $reuniao->dt_hr_reuniao);
                                        $dt_hr_reuniao = dataDbForm($var[0])." ".$var[1];

                                        if($reuniao->tp_reuniao == "Individual"){
                                            $membro = $reuniao->membro->nome;
                                        }
                                        elseif($reuniao->tp_reuniao == "Casal"){
                                            $membro = $reuniao->familia->pai()->nome." & ".$reuniao->familia->mae()->nome;
                                        }
                                        @endphp
                                        <tr>
                                            <td><span style='display:none'>{{ strtotime($reuniao->dt_hr_reuniao) }}</span>{{ $dt_hr_reuniao }}</td>
                                            <td>{{ $reuniao->tempo_reuniao }}</td>
                                            <td>{{ $reuniao->tp_reuniao }}</td>
                                            <td>{{ $membro }}</td>
                                            <td>{{ $reuniao->st_reuniao }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                                        <a class="dropdown-item waves-effect" href="{{ route('agendas.acessar_reuniao', $reuniao->id) }}"><i class="mdi mdi-page-next-outline me-1"></i> Acessar</a>
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
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[0, 'desc']],
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
