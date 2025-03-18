@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-danger mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Visitantes - Excluir</h4>
        </div>
        <hr>
        <form action="{{ route('visitantes.delete') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="membro_id" value="{{ $membro->id }}">
            <div class="row mt-5">
                <div class="col-md-12 mt-3">
                    <p>Tem certeza que deseja excluir o visitante {{ $membro->nome }}?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
@endsection
