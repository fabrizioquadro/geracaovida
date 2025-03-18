@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Visualizar</h4>
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
            <div class="col-md-5 form-group mt-3">
                <label for="nome">Nome:</label><br>
                <b>{{ $membro->nome }}</b>
            </div>
            @if($membro->conjugue())
                <div class="col-md-5 form-group mt-3">
                    <label for="nome">Conjugue:</label><br>
                    <b>{{ $membro->conjugue()->nome }}</b>
                </div>
            @endif
            <div class="col-md-2 form-group mt-3">
                <label for="genero">Gênero:</label><br>
                <b>{{ $membro->genero }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group mt-3">
                <label for="fone">Fone:</label><br>
                <b>{{ $membro->fone }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="email">Email:</label><br>
                <b>{{ $membro->email }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="dt_nascimento">Nascimento:</label><br>
                <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="data_batismo">Data Batismo:</label><br>
                <b>{{ dataDbForm($membro->data_batismo) }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group mt-3">
                <label for="cooperador">Cooperador:</label><br>
                <b>{{ $membro->cooperador }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="funcao">Função:</label><br>
                <b>{{ $membro->funcao }}</b>
            </div>
            <div class="col-md-3 form-group mt-3">
                <label for="igreja_anterior">Igreja Anterior:</label><br>
                <b>{{ $membro->igreja_anterior }}</b>
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
        @if($membro->familia_filhos())
            <div class="mt-5 card card-border-shadow-primary mb-4">
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
    </div>
</div>
@endsection
