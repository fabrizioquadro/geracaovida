@extends('layout/sistema')

@section('conteudo')

@php
if($user->imagem){
    $avatar = "/public/img/users/".$user->imagem;
}
else{
    if($user->ds_genero == "Masculino"){
        $avatar = "/public/template/img/avatars/1.png";
    }
    else{
        $avatar = "/public/template/img/avatars/2.png";
    }
}
@endphp
<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Perfil</h3>
                <hr>
                @if($mensagem = Session::get('mensagem'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        {{ $mensagem }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 mt-4" src="{{ asset($avatar) }}" height="120" width="120" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4>{{ $user->nm_usuario }}</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2 gy-4">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="text" id="nome" name="nm_usuario" value="{{ $user->nm_usuario }}" />
                                <label for="nome">Nome:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" />
                                <label for="email">Email:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <select class="form-select" id="ds_genero" name='ds_genero' aria-label="Default select example">
                                    <option @if($user->ds_genero == "Masculino") selected @endif value="Masculino">Masculino</option>
                                    <option @if($user->ds_genero == "Feminino") selected @endif value="Feminino">Feminino</option>
                                </select>
                                <label for="ds_genero">Gênero</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="file" id="imagem" name="imagem" />
                                <label for="imagem">Imagem:</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
