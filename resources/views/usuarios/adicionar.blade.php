@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Usuários - Adicionar</h4>
        </div>
        <hr>
        <form action="{{ route('usuarios.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nm_usuario"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="email" id="email" name="email"/>
                        <label for="email">Email:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="ds_genero" name='ds_genero' aria-label="Default select example">
                            <option value=""></option>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                        <label for="ds_genero">Gênero:</label>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="tp_usuario" name='tp_usuario' aria-label="Default select example">
                            <option value=""></option>
                            <option value="Administrador">Administrador</option>
                            <option value="Boas Vindas">Boas Vindas</option>
                            <option value="Líder Cultos">Líder Cultos</option>
                            <option value="Líder Visítas">Líder Visítas</option>
                            <option value="Secretaria">Secretaria</option>
                            <option value="Usuário">Usuário</option>
                        </select>
                        <label for="tp_usuario">Tipo:</label>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="st_atendimento" name='st_atendimento' aria-label="Default select example">
                            <option value=""></option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                        <label for="st_atendimento">Atendimento Individual:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="imagem" name="imagem"/>
                        <label for="imagem">Imagem:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="password" id="password" name="password"/>
                        <label for="password">Senha:</label>
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
                                    <input class="form-check-input" type="checkbox" name="ministerios[]" value="{{ $ministerio->id }}" id="defaultCheck1">
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
