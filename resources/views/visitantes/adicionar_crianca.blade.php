@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Visitante - Adicionar Criança</h4>
        </div>
        <hr>
        <form action="{{ route('visitantes.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tipo" value="{{ $tipo }}">
            <input type="hidden" name="genero" value="Criança">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nome"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="foto" name="foto"/>
                        <label for="foto">Foto:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="date" id="dt_nascimento" name="dt_nascimento"/>
                        <label for="dt_nascimento">Nascimento:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="pai" name='pai_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($pais as $pai)
                                <option value="{{ $pai->id }}">{{ $pai->nome }}</option>
                            @endforeach
                        </select>
                        <label for="pai">Pai:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="mae" name='mae_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($maes as $mae)
                                <option value="{{ $mae->id }}">{{ $mae->nome }}</option>
                            @endforeach
                        </select>
                        <label for="mae">Mãe:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="alergico" name="alergico"/>
                        <label for="alergico">Alérgico:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="recebeu_lembranca" name="recebeu_lembranca"/>
                        <label for="recebeu_lembranca">Recebeu Lembrança?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="obs" name="obs" placeholder="Observação do membro"></textarea>
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
