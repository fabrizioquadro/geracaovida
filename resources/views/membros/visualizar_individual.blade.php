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
            <div class="col-md-3 mt-3 form-group">
                <label for="nome">Nome:</label><br>
                <b>{{ $membro->nome }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="foto">Situação:</label><br>
                <b>{{ $membro->situacao }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="conjugue">Conjugue:</label><br>
                <b>{{ $membro->conjugue() ? $membro->conjugue()->nome : '' }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="genero">Gênero:</label><br>
                <b>{{ $membro->genero }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mt-3 form-group">
                <label for="fone">Fone:</label><br>
                <b>{{ $membro->fone }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="email">Email:</label><br>
                <b>{{ $membro->email }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="dt_nascimento">Nascimento:</label><br>
                <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
            </div>
            @if($membro->situacao == "Membro")
                <div class="col-md-3 mt-3 form-group">
                    <label for="data_batismo">Data Batismo:</label><br>
                    <b>{{ dataDbForm($membro->data_batismo) }}</b>
                </div>
            @else
                <div class="col-md-3 mt-3 form-group">
                    <label for="como_veio">Como Veio?</label><br>
                    <b>{{ $membro->como_veio }}</b>
                </div>
            @endif
        </div>
        <div class="row">
            @if($membro->situacao == "Membro")
                <div class="col-md-3 mt-3 form-group">
                    <label for="cooperador">Cooperador:</label><br>
                    <b>{{ $membro->cooperador }}</b>
                </div>
                <div class="col-md-3 mt-3 form-group">
                    <label for="funcao">Função:</label><br>
                    <b>{{ $membro->funcao }}</b>
                </div>
            @else
                <div class="col-md-3 mt-3 form-group">
                    <label for="postar_redes">Postar nas Redes?</label><br>
                    <b>{{ $membro->postar_redes }}</b>
                </div>
                <div class="col-md-3 mt-3 form-group">
                    <label for="aceita_msg">Aceita Mensagem?</label><br>
                    <b>{{ $membro->aceita_msg }}</b>
                </div>
            @endif
            <div class="col-md-3 mt-3 form-group">
                <label for="igreja_anterior">Igreja Anterior:</label><br>
                <b>{{ $membro->igreja_anterior }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="recebeu_lembranca">Recebeu Lembrança?</label><br>
                <b>{{ $membro->recebeu_lembranca }}</b>
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
        @if($membro->filhos()->count() > 0)
            <div class="card card-border-shadow-primary mb-4 mt-5">
                <div class="card-body">
                    <h6 class="card-title">Filhos</h6>
                    <ul>
                        @foreach($membro->filhos() as $filho)
                            <li>{{ $filho->nome }}</li>
                        @endforeach
                    </ul>
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
