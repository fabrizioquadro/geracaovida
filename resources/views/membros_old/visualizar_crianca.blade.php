@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Visualizar Criança</h4>
        </div>
        <hr>
        @if($membro->foto)
            <div class="row">
                <div class="col-md-3">
                    <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px' alt="">
                </div>
            </div>
        @endif
        <div class="row mt-5">
            <div class="col-md-8 form-group mt-3">
                <label for="nome">Nome:</label><br>
                <b>{{ $membro->nome }}</b>
            </div>
            <div class="col-md-4 form-group mt-3">
                <label for="dt_nascimento">Nascimento:</label><br>
                <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group mt-3">
                <label for="pai">Pai:</label><br>
                <b>{{ $membro->familia_crianca() ? $membro->pai()->nome : '' }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="mae">Mãe:</label><br>
                <b>{{ $membro->familia_crianca() ? $membro->mae()->nome : '' }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="alergico">Alérgico:</label><br>
                <b>{{ $membro->alergico }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="recebeu_lembranca">Recebeu Lembrança?</label><br>
                <b>{{ $membro->recebeu_lembranca }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group mt-3">
                <label for="obs">Observação</label><br>
                <b>{{ $membro->obs }}</b>
            </div>
        </div>
        @if($membro->irmaos()->count() > 0)
            <div class="mt-5 card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Irmãos</h6>
                    <ul>
                        @foreach($membro->irmaos() as $irmao)
                            <li>{{ $irmao->nome }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
