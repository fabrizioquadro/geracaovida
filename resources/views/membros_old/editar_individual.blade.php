@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Editar</h4>
        </div>
        <hr>
        <form action="{{ route('membros.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="membro_id" value="{{ $membro->id }}">
            @if($membro->foto)
                <div class="row">
                    <div class="col-md-3">
                        <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px' alt="">
                    </div>
                </div>
            @endif
            <div class="row mt-5">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nome" value="{{ $membro->nome }}"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="genero" name='genero' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($membro->genero == "Feminino") selected @endif value="Feminino">Feminino</option>
                            <option @if($membro->genero == "Masculino") selected @endif value="Masculino">Masculino</option>
                        </select>
                        <label for="genero">Gênero:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="foto" name="foto"/>
                        <label for="foto">Foto:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="fone" name="fone" value="{{ $membro->fone }}" onkeypress="mascara( this, mtel )"/>
                        <label for="fone">Fone:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="email" id="email" name="email" value="{{ $membro->email }}"/>
                        <label for="email">Email:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="date" id="dt_nascimento" name="dt_nascimento" value="{{ $membro->dt_nascimento }}"/>
                        <label for="dt_nascimento">Nascimento:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="date" id="data_batismo" name="data_batismo" value="{{ $membro->data_batismo }}"/>
                        <label for="data_batismo">Data Batismo:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="cooperador" name="cooperador" value="{{ $membro->cooperador }}"/>
                        <label for="cooperador">Cooperador:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="funcao" name="funcao" value="{{ $membro->funcao }}"/>
                        <label for="funcao">Função:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="igreja_anterior" name="igreja_anterior" value="{{ $membro->igreja_anterior }}"/>
                        <label for="igreja_anterior">Igreja Anterior:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="recebeu_lembranca" name="recebeu_lembranca" value="{{ $membro->recebeu_lembranca }}"/>
                        <label for="recebeu_lembranca">Recebeu Lembrança?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="obs" name="obs" placeholder="Observação do membro">{{ $membro->obs }}</textarea>
                        <label for="obs">Observação</label>
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
