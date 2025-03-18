@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretária Visitas</h4>
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
                        <th>Solicitação</th>
                        <th>Agendamento</th>
                        <th>Membro</th>
                        <th>Email</th>
                        <th>Fone</th>
                        <th>Situação</th>
                        <th>Usuário</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach($visitas as $visita)
                        @php
                        $var = explode(' ', $visita->created_at);
                        $solicitacao = dataDbForm($var[0])." ".$var[1];
                        if($visita->dt_hr_visita){
                            $var = explode(' ', $visita->dt_hr_visita);
                            $agendamento = dataDbForm($var[0])." ".$var[1];
                        }
                        else{
                            $agendamento = NULL;
                        }
                        @endphp
                        <tr>
                            <td><span style='display:none'>{{ strtotime($visita->created_at) }}</span>{{ $solicitacao }}</td>
                            <td><span style='display:none'>{{ strtotime($visita->dt_hr_visita) }}</span>{{ $agendamento }}</td>
                            <td>{{ $visita->membro->nome }}</td>
                            <td>{{ $visita->membro->email }}</td>
                            <td>{{ $visita->membro->fone }}</td>
                            <td>{{ $visita->st_visita }}</td>
                            <td>{{ $visita->user ? $visita->user->nm_usuario : '' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        {{--
                                        <a class="dropdown-item waves-effect" href="{{ route('visitas.agendamento', $visita->id) }}"><i class="mdi mdi-clipboard-text-clock-outline me-1"></i> Agendamento</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('visitas.feedback', $visita->id) }}"><i class="mdi mdi-message-alert-outline me-1"></i> Feedback</a>
                                        --}}
                                        <a class="dropdown-item waves-effect" href="{{ route('visitas.acessar', $visita->id) }}"><i class="mdi mdi-page-next-outline me-1"></i> Acessar</a>
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
