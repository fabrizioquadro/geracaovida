@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Usuários - Editar</h4>
        </div>
        <hr>
        <form action="{{ route('usuarios.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nm_usuario" value="{{ $user->nm_usuario }}"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="email" id="email" name="email" value="{{ $user->email }}"/>
                        <label for="email">Email:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="ds_genero" name='ds_genero' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($user->ds_genero == "Feminino") selected @endif value="Feminino">Feminino</option>
                            <option @if($user->ds_genero == "Masculino") selected @endif value="Masculino">Masculino</option>
                        </select>
                        <label for="ds_genero">Gênero:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="tp_usuario" name='tp_usuario' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($user->tp_usuario == "Administrador") selected @endif value="Administrador">Administrador</option>
                            <option @if($user->tp_usuario == "Boas Vindas") selected @endif value="Boas Vindas">Boas Vindas</option>
                            <option @if($user->tp_usuario == "Líder Cultos") selected @endif value="Líder Cultos">Líder Cultos</option>
                            <option @if($user->tp_usuario == "Líder Visítas") selected @endif value="Líder Visítas">Líder Visítas</option>
                            <option @if($user->tp_usuario == "Secretaria") selected @endif value="Secretaria">Secretaria</option>
                            <option @if($user->tp_usuario == "Usuário") selected @endif value="Usuário">Usuário</option>
                        </select>
                        <label for="tp_usuario">Tipo:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="st_atendimento" name='st_atendimento' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($user->st_atendimento == "Sim") selected @endif value="Sim">Sim</option>
                            <option @if($user->st_atendimento == "Não") selected @endif value="Não">Não</option>
                        </select>
                        <label for="st_atendimento">Atendimento Individual:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="imagem" name="imagem"/>
                        <label for="imagem">Imagem:</label>
                    </div>
                </div>
            </div>
            <div class="card card-border-shadow-info mt-3">
                <div class="card-body">
                    <h6 class="card-title">Ministérios</h6>
                    <div class="row">
                        @foreach($ministerios as $ministerio)
                            <div class="col-md-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" {{ $user->ministerios()->where('ministerio_id', $ministerio->id)->first() ? 'checked' : '' }} type="checkbox" name="ministerios[]" value="{{ $ministerio->id }}" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1"> {{ $ministerio->nm_ministerio }} </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
