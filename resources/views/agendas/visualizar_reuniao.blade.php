@extends('layout/sistema')

@section('conteudo')
@php
$horario = explode(' ',$reuniao->dt_hr_reuniao);
@endphp
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Reunião - Visualizar</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-4 mt-3 form-group">
                <label for="">Horário Reunião:</label><br>
                <b>{{ dataDbForm($horario[0])." ".$horario[1] }}</b>
            </div>
            <div class="col-md-4 mt-3 form-group">
                <label for="">Situação:</label><br>
                <b>{{ $reuniao->st_reuniao }}</b>
            </div>
            <div class="col-md-4 mt-3 form-group">
                <label for="">Tipo de Reunião:</label><br>
                <b>{{ $reuniao->tp_reuniao }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 form-group">
                <label for="">Descrição de Reunião:</label><br>
                <b>{{ $reuniao->ds_reuniao }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5 form-group">
                <label for="">Parecer de Reunião:</label><br>
                <b>{{ $reuniao->ds_parecer }}</b>
            </div>
        </div>
        <h5 class="card-title mt-5">Participantes</h5>
        <ul class="list-group">
            @foreach($reuniao->presencas as $presenca)
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <div class="form-check form-check-primary mt-3">
                          <label class="form-check-label" for="presenca_nome">{{ $presenca->membro->nome }}</label>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
