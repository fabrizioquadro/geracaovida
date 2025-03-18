@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria Atividades - Excluir</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('secretaria.atividades.delete') }}" method="post">
            @csrf
            <input type="hidden" name="culto_id" value="{{ $culto->id }}">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <p>Tm certeza que deseja excluir a atividade?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
@endsection
