@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Presenças {{ $culto->tp_culto." - ( ".$culto->nm_culto." )" }}</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <h4 class="card-title">Membros</h4>
        <div class="table-responsive">
            <table class="datatables-products table" id="table-index">
                <thead class="table-light">
                    <tr>
                        <th style='width: 90% !important'>Nome</th>
                        @if($culto->tp_culto == 'Ceia')
                            <th class="text-center">Oração</th>
                        @endif
                        <th class="text-center">Presente</th>
                    </tr>
                </head>
                <tbody class="table-bordered">
                    @foreach($membros as $membro)
                    <tr>
                        <td>{{ $membro->nome }}</td>
                        @if($culto->tp_culto == 'Ceia')
                            <td class="text-center">
                                <div class="form-check mt-3 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca_oracao(this, {{ $membro->id }})" {{ $membro->confere_presenca_oracao($culto->id) }}>
                                </div>
                            </td>
                        @endif
                        <td class="text-center">
                            <div class="form-check mt-3 text-center">
                                <input class="form-check-input" type="checkbox" value="" id="input_presenca_{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <h4 class="card-title">Visitantes Frequentes</h4>
        <div class="table-responsive">
            <table class="datatables-products table" id="table-index">
                <thead class="table-light">
                    <tr>
                        <th style='width: 90% !important'>Nome</th>
                        @if($culto->tp_culto == 'Ceia')
                            <th class="text-center">Oração</th>
                        @endif
                        <th class="text-center">Presente</th>
                    </tr>
                </head>
                <tbody class="table-bordered">
                    @foreach($frequentes as $membro)
                    <tr>
                        <td>{{ $membro->nome }}</td>
                        @if($culto->tp_culto == 'Ceia')
                            <td class="text-center">
                                <div class="form-check mt-3 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca_oracao(this, {{ $membro->id }})" {{ $membro->confere_presenca_oracao($culto->id) }}>
                                </div>
                            </td>
                        @endif
                        <td class="text-center">
                            <div class="form-check mt-3 text-center">
                                <input class="form-check-input" type="checkbox" value="" id="input_presenca_{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <h4 class="card-title">Primeiras Visitas</h4>
        <div class="table-responsive">
            <table class="datatables-products table" id="table-index">
                <thead class="table-light">
                    <tr>
                        <th style='width: 90% !important'>Nome</th>
                        @if($culto->tp_culto == 'Ceia')
                            <th class="text-center">Oração</th>
                        @endif
                        <th class="text-center">Presente</th>
                    </tr>
                </head>
                <tbody class="table-bordered">
                    @foreach($primeiras as $membro)
                    <tr>
                        <td>{{ $membro->nome }}</td>
                        @if($culto->tp_culto == 'Ceia')
                            <td class="text-center">
                                <div class="form-check mt-3 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca_oracao(this, {{ $membro->id }})" {{ $membro->confere_presenca_oracao($culto->id) }}>
                                </div>
                            </td>
                        @endif
                        <td class="text-center">
                            <div class="form-check mt-3 text-center">
                                <input class="form-check-input" type="checkbox" value="" id="input_presenca_{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
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
function set_presenca_oracao(elem, membro_id){
    let tipo;
    if(elem.checked){
        tipo = 'inserir';
    }
    else{
        tipo = 'retirar';
    }
    $.getJSON(
        '{{ route("cultos.set_presencas_oracao") }}',
        {
            tipo : tipo,
            membro_id : membro_id,
            culto_id : {{ $culto->id }}
        },
        function(json){
            if(json.tipo == "inserir"){
                document.getElementById('input_presenca_' + json.membro_id).checked = true;
            }
            else{
                document.getElementById('input_presenca_' + json.membro_id).checked = false;
            }

            if(json.controle != 'true'){
                alert('Ocorreu um erro no sistema');
                window.location.reload(true);
            }
        }
    );
}

function set_presenca(elem, membro_id){
    let tipo;
    if(elem.checked){
        tipo = 'inserir';
    }
    else{
        tipo = 'retirar';
    }
    $.getJSON(
        '{{ route("cultos.set_presencas") }}',
        {
            tipo : tipo,
            membro_id : membro_id,
            culto_id : {{ $culto->id }}
        },
        function(json){
            if(json.controle != 'true'){
                alert('Ocorreu um erro no sistema');
                window.location.reload(true);
            }
        }
    );
}

window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[0, 'asc']],
    'paginate': false,
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

  $('#table-index2').DataTable({
    order: [[0, 'asc']],
    'paginate': false,
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

  $('#table-index3').DataTable({
    order: [[0, 'asc']],
    'paginate': false,
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
