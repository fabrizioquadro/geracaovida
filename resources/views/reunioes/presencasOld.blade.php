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
        <ul class="list-group">
            <li class="list-group-item list-group-item-primary">Membros</li>
            @foreach($membros as $membro)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <span>{{ $membro->nome }}</span>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="list-group mt-3">
            <li class="list-group-item list-group-item-primary">Visitantes Frequentes</li>
            @foreach($frequentes as $membro)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <span>{{ $membro->nome }}</span>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="list-group mt-3">
            <li class="list-group-item list-group-item-primary">Primeiras Visitas</li>
            @foreach($primeiras as $membro)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <span>{{ $membro->nome }}</span>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{ $membro->id }}" onclick="set_presenca(this, {{ $membro->id }})" {{ $membro->confere_presenca($culto->id) }}>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
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
</script>
@endsection
