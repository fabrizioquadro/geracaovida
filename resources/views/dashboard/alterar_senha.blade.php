@extends('layout/sistema')

@section('conteudo')

@php
$user = auth()->user();
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
                <h3 class="card-title">Alterar Senha</h3>
                <hr>
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 mt-4" src="{{ asset($avatar) }}" height="120" width="120" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4>{{ $user->nm_usuario }}</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <form method="POST" action="{{ route('alterar_senha.update') }}">
                    @csrf
                    <div class="row mt-2 gy-4">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="password" id="password" name="password" />
                                <label for="password">Nova Senha:</label>
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
