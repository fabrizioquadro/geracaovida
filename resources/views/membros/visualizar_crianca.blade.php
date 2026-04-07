@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Visualizar {{ $membro->genero }}</h4>
        </div>
        <hr>
        @if($membro->foto)
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px; max-height: 100px' alt="">
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <label for="">Presença Últimos 10 Cultos/Reuniões</label><br>
                <b>{{ $membro->get_presenca() }}%</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group mt-3">
                <label for="nome">Nome:</label><br>
                <b>{{ $membro->nome }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="foto">Situação:</label><br>
                <b>{{ $membro->situacao }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="dt_nascimento">Nascimento:</label><br>
                <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="genero">Gênero:</label><br>
                <b>{{ $membro->genero }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mt-3 form-group">
                <label for="fone">Telefone:</label><br>
                <b>{{ $membro->fone }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="pai">Pai:</label><br>
                <b>{{ $membro->pai() ? $membro->pai()->nome : '' }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="mae">Mãe:</label><br>
                <b>{{ $membro->mae() ? $membro->mae()->nome : '' }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="alergico">Alérgico:</label><br>
                <b>{{ $membro->alergico }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="recebeu_lembranca">Recebeu Lembrança?</label><br>
                <b>{{ $membro->recebeu_lembranca }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="">Autorizou Postagem?</label><br>
                <b>{{ $membro->postar_redes }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="">CPF:</label><br>
                <b>{{ $membro->cpf }}</b>
            </div>
            <div class="col-md-6 mt-3 form-group">
                <label for="">Endereço:</label><br>
                <b>{{ $membro->endereco }}</b>
            </div>
        </div>
        @if($membro->obs)
            <div class="row">
                <div class="col-md-12 mt-3 form-group">
                    <label for="obs">Observação</label><br>
                    <b>{{ $membro->obs }}</b>
                </div>
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-start mt-3">
            <audio id='audio_source' controls="controls" src='{{ $membro->audio_base64 }}'>
            </audio>
        </div>
    </div>
</div>
@endsection
