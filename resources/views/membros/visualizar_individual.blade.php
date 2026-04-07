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
            @if($membro->situacao == "Membro")
                <div class="col-md-2 mt-3 form-group">
                    <label for="dt_nascimento">Nascimento:</label><br>
                    <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
                </div>
                <div class="col-md-2 mt-3 form-group">
                    <label for="">Tipo Batismo:</label><br>
                    <b>{{ $membro->st_batismo }}</b>
                </div>
                <div class="col-md-2 mt-3 form-group">
                    <label for="data_batismo">Data Batismo:</label><br>
                    <b>{{ dataDbForm($membro->data_batismo) }}</b>
                </div>
            @else
                <div class="col-md-3 mt-3 form-group">
                    <label for="dt_nascimento">Nascimento:</label><br>
                    <b>{{ dataDbForm($membro->dt_nascimento) }}</b>
                </div>
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
            <div class="col-md-3 mt-3 form-group">
                <label for="">CPF:</label><br>
                <b>{{ $membro->cpf }}</b>
            </div>
            <div class="col-md-3 mt-3 form-group">
                <label for="">RG:</label><br>
                <b>{{ $membro->rg }}</b>
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
        <div class="card card-border-shadow-primary mb-4 mt-5">
            <div class="card-body">
                <h4 class="card-title">Família</h4>
                @if($membro->conjugue())
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="">Conjugue:</label><br>
                            <a style="color: #696969 !important" href="{{ route('membros.visualizar', $membro->conjugue()->id) }}"><b>{{ $membro->conjugue()->nome }}</b></a></td>
                        </div>
                    </div>
                @endif
                <div class="row">
                    @if($membro->pai())
                        <div class="col-md-6 form-group mb-3">
                            <label for="">Pai:</label><br>
                            <b>{{ $membro->pai()->nome }}</b>
                            <a style="color: #696969 !important" href="{{ route('membros.visualizar', $membro->pai()->id) }}"><b>{{ $membro->pai()->nome }}</b></a></td>
                        </div>
                    @endif
                    @if($membro->mae())
                        <div class="col-md-6 form-group mb-3">
                            <label for="">Mãe:</label><br>
                            <a style="color: #696969 !important" href="{{ route('membros.visualizar', $membro->mae()->id) }}"><b>{{ $membro->mae()->nome }}</b></a></td>
                        </div>
                    @endif
                </div>
                @if($membro->filhos()->count() > 0)
                    <hr>
                    <h5 class="card-title mt-1">Filhos</h5>
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($membro->filhos() as $filho)
                                <tr>
                                    <td> <a style="color: #696969 !important" href="{{ route('membros.visualizar', $filho->id) }}">{{ $filho->nome }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-start mt-3">
            <audio id='audio_source' controls="controls" src='{{ $membro->audio_base64 }}'>
            </audio>
        </div>
    </div>
</div>
@endsection
