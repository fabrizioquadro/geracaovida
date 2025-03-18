@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria - Visitas - Editar</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 form-group mt-3">
                <label for="membro_id">Membro:</label><br>
                <b>{{ $visita->membro->nome }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group mt-3">
                <label for="ds_visita">Descrição</label><br>
                <b>{{ $visita->ds_visita }}</b>
            </div>
        </div>
        <h6 class="card-title mt-5">Endereço</h6>
        <div class="row">
            <div class="col-md-3 mt-3 form-group">
                <label for="cep">CEP:</label><br>
                <b>{{ $visita->nr_cep }}</b>
            </div>
            <div class="col-md-6 mt-3 form-group">
                <label for="endereco">Endereço:</label><br>
                <b>{{ $visita->ds_endereco }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="numero">Número:</label><br>
                <b>{{ $visita->nr_endereco }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mt-3 form-group">
                <label for="complemento">Complemento:</label><br>
                <b>{{ $visita->ds_complemento }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="bairro">Bairro:</label><br>
                <b>{{ $visita->ds_bairro }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="cidade">Cidade:</label><br>
                <b>{{ $visita->nm_cidade }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="uf">UF:</label><br>
                <b>{{ $visita->ds_uf }}</b>
            </div>
        </div>
        @if($visita->audio_base64)
            <audio id='audio_source' style="margin-top: 25px" controls="controls" src='{{ $visita->audio_base64 }}'>
            </audio>
        @endif
    </div>
</div>
@endsection
