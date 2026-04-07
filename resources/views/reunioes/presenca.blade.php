@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">{{ $culto->nm_culto }} - Presenças</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <h4 class="card-title mt-5">Membros </h4>
        <table class="table mt-5">
            <tbody>
                @foreach($culto->reservas() as $reserva)
                    <tr>
                        <td style="width: 25px !important"><input id="input_" class="form-check-input" type="checkbox" onclick="set_presenca(this, {{ $reserva->membro_id }})" {{ $reserva->membro->confere_presenca($culto->id) }}></td>
                        <th>{{ $reserva->membro->nome }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4 class="card-title mt-5">Convites </h4>
        <table class="table mt-5">
            <tbody>
                @foreach($culto->convites() as $reserva)
                    <tr>
                        <td style="width: 25px !important"><input id="input_convite" class="form-check-input" type="checkbox" onclick="set_presenca_convite(this, {{ $reserva->id }})" {{ $reserva->presenca_convite == 'Sim' ? 'checked' : '' }}></td>
                        <th>{{ $reserva->nm_convite }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
function set_presenca(elem, membro_id){
    let tipo;
    if(elem.checked){
        tipo = 'inserir';
    }
    else{
        tipo = 'retirar';
    }
    $.getJSON(
        '{{ route("cultos_reunioes.set_presencas") }}',
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

function set_presenca_convite(elem, reserva_id){
    let tipo;
    if(elem.checked){
        tipo = 'inserir';
    }
    else{
        tipo = 'retirar';
    }
    $.getJSON(
        '{{ route("reunioes.set_presenca_convite") }}',
        {
            tipo : tipo,
            reserva_id : reserva_id,
        },
        function(json){
            if(json.controle != 'true'){
                alert('Ocorreu um erro no sistema');
                window.location.reload(true);
            }
        }
    );
}
</script>
@endsection
