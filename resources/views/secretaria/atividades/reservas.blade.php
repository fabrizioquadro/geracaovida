@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria Atividades - Reservas</h4>
        </div>
        <hr>
        <h4 class="card-title">Membros </h4>
        <table class="table">
            <tbody>
                @foreach($atividade->ministerios as $ministerio)
                    @foreach($ministerio->membros() as $membro)
                    <tr>
                        <td style="width: 25px !important"><input @if($atividade->check_reserva($membro->membro->id)) checked @endif id="input_{{ $membro->membro->id }}" class="form-check-input" type="checkbox" onchange="seta_reserva_membro({{ $membro->membro->id }})"></td>
                        <td>{{ $membro->membro->nome }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <h4 class="card-title mt-5">Convidados </h4>
        <form action="{{ route('secretaria.atividades.reservas.set_convite') }}" method="post">
            @csrf
            <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nm_convite" name="nm_convite"/>
                        <label for="nm_convite">Nome:</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </div>
            </div>
        </form>
        <table class="table mt-5">
            <tbody>
                @foreach($atividade->convites() as $convite)
                    <tr>
                        <th>{{ $convite->nm_convite }}</th>
                        <th> <button type="button" class="btn btn-sm btn-danger" onclick="excluir_convite({{ $convite->id }})">Excluir</button> </th>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</div>
<script>
function seta_reserva_membro(membro_id){
    if(document.getElementById('input_' + membro_id).checked){
        acao = "inserir";
    }
    else{
        acao = "retirar";
    }

    $.getJSON(
        '{{ route("secretaria.atividades.reservas.set") }}',
        {
            atividade_id : {{ $atividade->id }},
            membro_id : membro_id,
            acao : acao,
            tipo : 'membro'
        },
        function(json){

        }
    );
}

function excluir_convite(convite_id){
    if(confirm('Tem certeza que deseja excluir o convite?')){
        window.location.href = '{{ route("secretaria.atividades.reservas.delete_convite") }}/' + convite_id;
    }
}
</script>
@endsection
