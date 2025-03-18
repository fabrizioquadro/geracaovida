@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Batizar {{ $membro->nome }}</h4>
        </div>
        <hr>
        <form action="{{ route('membros.batizar_set') }}" method="post">
            @csrf
            <input type="hidden" name="membro_id" value="{{ $membro->id }}">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="date" id="data_batismo" name="data_batismo"/>
                        <label for="data_batismo">Data de Batismo:</label>
                    </div>
                </div>
                @if($membro->genero != 'Criança')
                    <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="cooperador" name="cooperador"/>
                            <label for="cooperador">Cooperador:</label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="funcao" name="funcao"/>
                            <label for="funcao">Função:</label>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
