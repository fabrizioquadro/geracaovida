@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-danger mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Família - Excluir</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('familias.delete') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="familia_id" value="{{ $familia->id }}">
            <div class="row">
                <div class="col-md-12 mt-3 form-group">
                    <p>Tem certeza que deseja excluir a família?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
@endsection
