@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-danger mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria - Visitas - Excluir</h4>
        </div>
        <hr>
        <form action="{{ route('secretaria.visitas.delete') }}" method="post">
            @csrf
            <input type="hidden" name="visita_id" value="{{ $visita->id }}">
            <div class="row">
                <div class="col-md-12 form-group mt-3">
                    <p>Tem certeza que deseja excluir a visita do membro {{ $visita->membro->nome }}?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
@endsection
